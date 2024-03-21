<?php

namespace App\Http\Controllers;

use App\Models\ChecklistKendaraan;
use App\Models\ItemInspeksi;
use App\Models\JenisKendaraan;
use App\Models\MasterDriver;
use App\Models\Mobil;
use App\Models\Supir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class ChecklistKendaraanController extends Controller
{
    public function index(){
        $month = Carbon::now()->isoFormat('M');
        $year = Carbon::now()->format('Y');
        if(Auth::user()->roles->first()->name == 'Driver'){
            $supir = MasterDriver::where('id_user', Auth::user()->id)->first();
            $mobil = Mobil::where('id_entitas', 1)
            ->where('id_status', 8)
            ->where('id_supir', $supir->id)
            ->get();
            return view('apps.checklist-kendaraan.driver.index', compact('mobil', 'month', 'year'));
        }else{
            $mobil = Mobil::where('id_entitas', 1)->where('id_status', 8)->get();
        }
        return view('apps.checklist-kendaraan.admin.index', compact('mobil', 'year', 'month'));
    }

    public function create($id){
        $supir= Supir::where('id_user', Auth::user()->id)->first();
        $mobil = Mobil::find(Crypt::decrypt($id));
        $item_inspeksi = ItemInspeksi::get();
        return view('apps.checklist-kendaraan.create', compact('supir', 'mobil', 'item_inspeksi'));
    }

    public function store(Request $request){
        $tanggalSekarang = Carbon::now();
        $bulanSekarang  = $tanggalSekarang->format('m');
        $count = ChecklistKendaraan::whereYear('created_at', $tanggalSekarang->year)
            ->whereMonth('created_at', $tanggalSekarang->month)
            ->count() + 1;
        $formatJumlahCreate = str_pad($count, 3, '0', STR_PAD_LEFT);
        $kodeForm = 'CMD131-UPC-' . $formatJumlahCreate . '/' . $bulanSekarang;
        $request->merge([
            'id_supir' => $request->id_supir,
            'id_mobil' => $request->id_mobil,
            'id_status' => 1,
            'kode_form' => $kodeForm,
            'tgl_revisi' => Carbon::parse($request->tgl_revisi)->addDay(3),
            'tgl_berlaku' => Carbon::parse($request->tgl_berlaku)->addDay(7),
            'warning_stnk' => Carbon::parse($request->habis_stnk)->subMonths(1),
            'warning_service' => Carbon::parse($request->terakhir_service)->addMonths(6),
        ]);
        $detail = [
            'steering' => ['value' => $request->steering, 'ket' => $request->keterangan_steering ?? ''],
            'ban_cadangan' => ['value' => $request->ban_cadangan, 'ket' => $request->keterangan_ban_cadangan ?? ''],
            'lampu_depan' => ['value' => $request->lampu_depan, 'ket' => $request->keterangan_lampu_depan ?? ''],
            'lampu_belakang' => ['value' => $request->lampu_belakang, 'ket' => $request->keterangan_lampu_belakang ?? ''],
            'alarm_mundur' => ['value' => $request->alarm_mundur, 'ket' => $request->keterangan_alarm_mundur ?? ''],
            'level_oli' => ['value' => $request->level_oli, 'ket' => $request->keterangan_level_oli ?? ''],
            'minyak_rem' => ['value' => $request->minyak_rem, 'ket' => $request->keterangan_minyak_rem ?? ''],
            'air_radiator' => ['value' => $request->air_radiator, 'ket' => $request->keterangan_air_radiator ?? ''],
            'persneling' => ['value' => $request->persneling, 'ket' => $request->keterangan_persneling ?? ''],
            'main_brake' => ['value' => $request->main_brake, 'ket' => $request->keterangan_main_brake ?? ''],
            'parking_brake' => ['value' => $request->parking_brake, 'ket' => $request->keterangan_parking_brake ?? ''],
            'air_wiper' => ['value' => $request->air_wiper, 'ket' => $request->keterangan_air_wiper ?? ''],
            'klakson' => ['value' => $request->klakson, 'ket' => $request->keterangan_klakson ?? ''],
            'seatbelt' => ['value' => $request->seatbelt, 'ket' => $request->keterangan_seatbelt ?? ''],
            'segitiga' => ['value' => $request->segitiga, 'ket' => $request->keterangan_segitiga ?? ''],
            'apar' => ['value' => $request->apar, 'ket' => $request->keterangan_apar ?? ''],
            'kunci_roda' => ['value' => $request->kunci_roda, 'ket' => $request->keterangan_kunci_roda ?? ''],
            'jack' => ['value' => $request->jack, 'ket' => $request->keterangan_jack ?? ''],
            'general_lainnya' => $request->general_lainnya ?? '',
            'safety_lainnya' => $request->safety_lainnya ?? '',
            'kesimpulan' => $request->kesimpulan
        ];
        $detail = ['detail' => $detail];
        $checklist_kendaraan = ChecklistKendaraan::create([
            'detail_inspeksi' => json_encode($detail),
            'kode_form' => $request->kode_form,
            'tgl_inspeksi' => $request->tgl_inspeksi,
            'tgl_berlaku' => $request->tgl_berlaku,
            'tgl_revisi' => $request->tgl_revisi,
            'km_saat_inspeksi' => $request->km_saat_inspeksi,
            'id_supir' => $request->id_supir,
            'id_mobil' => $request->id_mobil,
            'id_status' => $request->id_status
        ]);
        $data['mobil'] = Mobil::find($request->id_mobil);
        $data['mobil']->update([
            'km_kendaraan' => $request->km_saat_inspeksi,
            'tgl_inspeksi_selanjutnya' => Carbon::parse($request->tgl_inspeksi)->next(Carbon::MONDAY),
        ]);
        $data['supir'] = Supir::find($request->id_supir);
        $data['supir']->update([
            'nomor_hp_darurat' => $request->no_hp_darurat
        ]);
        return redirect('checklist-kendaraan')->withSuccess('Berhasil melakukan Inspeksi');
    }

    public function show($id, $month, $year){
        $mobil = Mobil::find(Crypt::decrypt($id));
        $supir = Supir::find($mobil->id_supir);
        $start_date = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        if ($start_date->dayOfWeek !== Carbon::MONDAY) {
            $start_date->next(Carbon::MONDAY);
        }
        $end_date = $start_date->copy()->endOfMonth();
        $weeklyInspections = ChecklistKendaraan::where('id_mobil', Crypt::decrypt($id))->whereBetween('tgl_inspeksi', [$start_date, $end_date])
                ->get()
                ->groupBy(function ($inspection) {
                    return Carbon::parse($inspection->tgl_inspeksi)->weekOfYear;
                });

        $weeksInMonth = [];
        $currentDate = $start_date->copy();
        while ($currentDate->month == $month) {
            $weekNumber = $currentDate->weekOfMonth;

            $inspections = $weeklyInspections->get($currentDate->weekOfYear, []);

            $weeksInMonth[] = [
                'week_number' => $weekNumber,
                'start_date' => $currentDate->copy()->startOfWeek(),
                'end_date' => $currentDate->copy()->endOfWeek(),
                'inspections' => $inspections,
            ];

            $currentDate->addWeek();
        }

        return view('apps.checklist-kendaraan.admin.show', compact('mobil', 'supir', 'weeksInMonth', 'month', 'year'));
    }
}
