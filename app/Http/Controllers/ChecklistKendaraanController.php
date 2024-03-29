<?php

namespace App\Http\Controllers;

use App\Models\ChecklistKendaraan;
use App\Models\ItemInspeksi;
use App\Models\JenisKendaraan;
use App\Models\MasterDriver;
use App\Models\Mobil;
use App\Models\Supir;
use App\Models\TransaksiDetailInspeksi;
use Barryvdh\DomPDF\Facade\Pdf;
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
            $checklist_kendaraan = ChecklistKendaraan::where('id_supir', $supir->id)->get();
            return view('apps.checklist-kendaraan.driver.index', compact('checklist_kendaraan', 'mobil', 'month', 'year'));
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
        
        $checklist_kendaraan = ChecklistKendaraan::create([
            'kode_form' => $request->kode_form,
            'tgl_inspeksi' => $request->tgl_inspeksi,
            'tgl_berlaku' => $request->tgl_berlaku,
            'tgl_revisi' => $request->tgl_revisi,
            'km_saat_inspeksi' => $request->km_saat_inspeksi,
            'id_supir' => $request->id_supir,
            'id_mobil' => $request->id_mobil,
            'id_status' => $request->id_status,
            'alasan_telat' => $request->alasan_telat,
            'kesimpulan' => $request->kesimpulan
        ]);
        foreach($request->detail as $id => $value){
            TransaksiDetailInspeksi::create([
                'id_checklist_kendaraan' => $checklist_kendaraan->id,
                'id_item_inspeksi' => $id,
                'value' => $value['kondisi'],
                'ket' => $value['ket'],
            ]);
        }
        $mobil = Mobil::find($request->id_mobil);
        $mobil->update([
            'km_kendaraan' => $request->km_saat_inspeksi,
            'tgl_inspeksi_selanjutnya' => Carbon::parse($request->tgl_inspeksi)->next(Carbon::MONDAY),
        ]);
        $supir = Supir::find($request->id_supir);
        $supir->update([
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

    public function showInspeksi($id){
        $checklist_kendaraan = ChecklistKendaraan::find(Crypt::decrypt($id));
        $detailInspeksi['General'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'General');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'General');
        })->get();
        $detailInspeksi['Perlengkapan Safety'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        })->get();
        $jenis_kendaraan = JenisKendaraan::get();
        $supir = Supir::find($checklist_kendaraan->id_supir);
        $mobil = Mobil::find($checklist_kendaraan->id_mobil);

        return view('apps.checklist-kendaraan.admin.show-inspeksi', compact('checklist_kendaraan', 'detailInspeksi', 'jenis_kendaraan', 'supir', 'mobil'));
    }

    public function approve($id){
        $checklistKendaraan = ChecklistKendaraan::find($id);
        $checklistKendaraan->update([
            'id_status' => 2,
        ]);
        return response()->json(['checklist-kendaraan' => $checklistKendaraan, 'status' => 200]);
    }

    public function return($id){
        $checklistKendaraan = ChecklistKendaraan::find($id);
        $checklistKendaraan->update([
            'id_status' => 3,
        ]);
        return response()->json(['checklist-kendaraan' => $checklistKendaraan, 'status' => 200]);
    }

    public function edit($id){
        $checklist_kendaraan = ChecklistKendaraan::find($id);
        $detailInspeksi['General'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'General');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'General');
        })->get();
        $detailInspeksi['Perlengkapan Safety'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        })->get();
        $jenis_kendaraan = JenisKendaraan::get();
        $supir = Supir::find($checklist_kendaraan->id_supir);
        $mobil = Mobil::find($checklist_kendaraan->id_mobil);

        return view('apps.checklist-kendaraan.driver.edit', compact('checklist_kendaraan', 'detailInspeksi', 'jenis_kendaraan', 'supir', 'mobil'));
    }

    public function update(Request $request, $id){
        TransaksiDetailInspeksi::where('id_checklist_kendaraan', $id)->delete();
        foreach($request->detail as $index => $value){
            TransaksiDetailInspeksi::create([
                'id_checklist_kendaraan' => $id,
                'id_item_inspeksi' => $index,
                'value' => $value['kondisi'],
                'ket' => $value['ket'],
            ]);
        }
        $checklistKendaraan = ChecklistKendaraan::find($id);
        $checklistKendaraan->update([
            'id_status' => 1
        ]);
        return redirect('checklist-kendaraan');
    }

    public function print($id){
        $checklist_kendaraan = ChecklistKendaraan::find(Crypt::decrypt($id));
        $detailInspeksi['General'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'General');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'General');
        })->get();
        $detailInspeksi['Perlengkapan Safety'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        })->get();
        $supir = Supir::find($checklist_kendaraan->id_supir);
        $mobil = Mobil::find($checklist_kendaraan->id_mobil);
        $pdf = Pdf::loadView('apps.checklist-kendaraan.components.print', ([
            'checklistKendaraan' =>  $checklist_kendaraan,
            'i' => $detailInspeksi,
            'supir' => $supir,
            'mobil' => $mobil,
        ]))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    public function download($id){
        $checklist_kendaraan = ChecklistKendaraan::find(Crypt::decrypt($id));
        $detailInspeksi['General'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'General');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'General');
        })->get();
        $detailInspeksi['Perlengkapan Safety'] = TransaksiDetailInspeksi::with(['ItemInspeksi' => function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        }])->where('id_checklist_kendaraan', $checklist_kendaraan->id)
        ->whereHas('ItemInspeksi', function ($query) {
            $query->where('tipe_inspeksi', 'Perlengkapan Safety');
        })->get();
        $supir = Supir::find($checklist_kendaraan->id_supir);
        $mobil = Mobil::find($checklist_kendaraan->id_mobil);
        $pdf = Pdf::loadView('apps.checklist-kendaraan.components.print', ([
            'checklistKendaraan' =>  $checklist_kendaraan,
            'i' => $detailInspeksi,
            'supir' => $supir,
            'mobil' => $mobil,
        ]))->setPaper('a4', 'potrait');
        return $pdf->download(''.$checklist_kendaraan->kode_form.'.pdf');
    }
}
