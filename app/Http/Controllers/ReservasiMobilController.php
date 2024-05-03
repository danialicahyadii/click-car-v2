<?php

namespace App\Http\Controllers;

use App\Helpers\KodePemesananHelper;
use App\Models\ChecklistKendaraan;
use App\Models\JenisKendaraan;
use App\Models\Mobil;
use App\Models\Penumpang;
use App\Models\ReservasiMobil;
use App\Models\Supir;
use App\Models\TransaksiVoucher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ReservasiMobilController extends Controller
{

    public function data()
    {
        $data['penumpang'] = User::where('kode_entitas', Auth::user()->kode_entitas)->orderBy('name', 'ASC')->get();
        $data['atasan'] = User::whereIn('kode_jabatan', [Auth::user()->approval_1, Auth::user()->approval_2, Auth::user()->approval_3])->orderBy('level_jabatan', 'DESC')->get();
        // dd($data['atasan']);
        $data['jenis_kendaraan'] = JenisKendaraan::orderBy('nama', 'ASC')->get();
        $data['mobil'] = Mobil::where('id_entitas', Auth::user()->id_entitas)->orderBy('nama', 'ASC')->get();
        $data['supir'] = Supir::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->orderBy('nama', 'ASC')->get();
        $data['reservasi_mobil'] = ReservasiMobil::get();
        $data['penumpang_reservasi'] = Penumpang::with('user')->get();
        $data['voucher'] = TransaksiVoucher::get();

        return $data;
    }

    public function index()
    {
        $data = $this->data();
        $role = Auth::user()->roles->first()->name;
        $year = Carbon::now()->year;
        $vouchers = $data['voucher'];
        $belumRating = '';
        $checklistExists = false;
        if($role == 'Admin Umum'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        }elseif($role == 'Requester'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->where(function ($query) {
                $query->where('id_user', Auth::user()->id)
                    ->orWhere('id_atasan', Auth::user()->id);
                })->orderBy('id', 'desc')->get();
            $belumRating = $reservasi_mobil->where('flag_rating', null)->where('id_pengantaran', '!=', 3)->count();
        }elseif($role == 'Admin Driver'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            $vehicles = Mobil::where('id_supir', Auth::user()->supir->id)->get();
            if ($vehicles->isEmpty()) {
                $checklistExists = true;
            } else {
                // Jika $vehicles tidak kosong, lakukan pengecekan untuk setiap kendaraan
                foreach ($vehicles as $vehicle) {
                    // Mengecek apakah ada data checklist kendaraan untuk setiap kendaraan pada minggu ini
                    if (ChecklistKendaraan::where('id_mobil', $vehicle->id)
                        ->whereBetween('tanggal', [$startDate, $endDate])
                        ->exists()) {
                        // Jika ditemukan data checklist pada salah satu kendaraan, ubah $checklistExists ke true dan keluar dari loop
                        $checklistExists = true;
                        break;
                    }
                }
            }
        }elseif($role == 'Driver'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->where('id_supir', Auth::user()->supir->id)->orderBy('id', 'desc')->get();
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            $vehicles = Mobil::where('id_supir', Auth::user()->supir->id)->get();
            if ($vehicles->isEmpty()) {
                $checklistExists = true;
            } else {
                // Jika $vehicles tidak kosong, lakukan pengecekan untuk setiap kendaraan
                foreach ($vehicles as $vehicle) {
                    // Mengecek apakah ada data checklist kendaraan untuk setiap kendaraan pada minggu ini
                    if (ChecklistKendaraan::where('id_mobil', $vehicle->id)
                        ->whereBetween('tgl_inspeksi', [$startDate, $endDate])
                        ->exists()) {
                        // Jika ditemukan data checklist pada salah satu kendaraan, ubah $checklistExists ke true dan keluar dari loop
                        $checklistExists = true;
                        break;
                    }
                }
            }
        }else{
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        }
        
        return view('apps.reservasi-mobil.index', compact('reservasi_mobil', 'vouchers', 'belumRating', 'checklistExists'));
    }

    public function create()
    {
        $data = $this->data();
        $penumpang = $data['penumpang'];
        $atasan = $data['atasan'];
        $jenis_kendaraan = $data['jenis_kendaraan']->where('id', '!=', 8);
        $mobil = $data['mobil'];
        $supir = $data['supir'];

        return view('apps.reservasi-mobil.create', compact('penumpang', 'atasan', 'jenis_kendaraan', 'mobil', 'supir'));
    }

    public function store(Request $request)
    {
        $message = [
            'asal.required' => 'asal harus diisi',
            'tujuan' => 'tujuan harus diisi',
            'keperluan' => 'keperluan harus diisi',
            'id_penumpang' => 'penumpang harus diisi',
            'tgl_pergi' => 'tgl pergi harus diisi',
            'tgl_pulang' => 'tgl pulang harus diisi',
            'wktu_pergi' => 'waktu pergi harus diisi',
            'wktu_plng' => 'waktu pulang harus diisi',
            'id_atasan' => 'atasan harus diisi',
            'id_pengantaran' => 'tipe pengantaran harus diisi',
            'pic' => 'pic harus diisi',
            'nama' => 'nama harus diisi',
            'no_tlpn' => 'no telpon harus diisi',
            'komentar' => 'catatan harus diisi',
            
        ];
        $validatedData = $request->validate([
            'asal' => 'required',
            'tujuan' => 'required',
            'keperluan' => 'required',
            'id_penumpang' => 'required|array|min:1',
            'tgl_pergi' => 'required|date',
            'tgl_pulang' => 'required|date',
            'wktu_pergi' => 'required|date_format:H:i',
            'wktu_plng' => 'required|date_format:H:i',
            'id_atasan' => 'required',
            'id_pengantaran' => 'required',
            'pic' => 'required',
            'nama' => 'required',
            'no_tlpn' => 'required',
            'komentar' => 'required',
        ], $message);

        $dateDeparture = Carbon::create($validatedData['tgl_pergi'] . $validatedData['wktu_pergi']);
        $dateExpired = $dateDeparture->copy()->addMinute(30);
        $waktuKeberangkatan = $dateDeparture->copy()->subMinute(10);
        $request->merge([
            'id_user' => Auth::user()->id,
            'id_entitas' => Auth::user()->id_entitas,
            'jml_penumpang' => count($validatedData['id_penumpang']),
            'id_status' => 1,
            'date_expired' => $dateExpired,
            'waktu_keberangkatan' => $waktuKeberangkatan,
            'kode_pemesanan' => KodePemesananHelper::generateKodePemesanan(),
        ]);
        $reservasi_mobil = ReservasiMobil::create($request->except('id_penumpang'));

        if (!empty($request->id_penumpang)) {
            foreach ($request->id_penumpang as $row) {
                $penumpang = Penumpang::create([
                    'id_reservasi' => $reservasi_mobil->id,
                    'id_user' => $row,
                ]);
            }
        }
        // Notifikasi WA dan Email
        $atasan = User::find($reservasi_mobil->id_atasan);
        $wa = new WhatsappNotifikasiController();
        $wa->sendMessageApprove($reservasi_mobil, $atasan);

        activity()->log('Melakukan Pembuatan Reservasi Mobil dengan ID Pemesanan: ' . $reservasi_mobil->id);
        toast('Permintaan Reservasi ke ' . $reservasi_mobil->tujuan . ' Berhasil!', 'success')->timerProgressBar();

        return redirect(url('reservasi-mobil'))->withInput();
    }

    public function show($param)
    {
        $data = $this->data();
        if (is_numeric($param)) {
            $reservasi_mobil = $data['reservasi_mobil']->find($param);
            $penumpang = $data['penumpang_reservasi']->where('id_reservasi', $reservasi_mobil->id);
            $voucher = TransaksiVoucher::where('id_reservasi', $reservasi_mobil->id)->get();
        } else {
            $reservasi_mobil = $data['reservasi_mobil']->where('kode_pemesanan', $param)->first();
            $penumpang = $data['penumpang_reservasi']->where('id_reservasi', $reservasi_mobil->id);
            $voucher = TransaksiVoucher::where('id_reservasi', $reservasi_mobil->id)->get();
        }
        $jenis_kendaraan = $data['jenis_kendaraan'];
        $mobil = $data['mobil'];
        $supir = $data['supir'];

        return view('apps.reservasi-mobil.show', compact('reservasi_mobil', 'penumpang', 'jenis_kendaraan', 'mobil', 'supir', 'voucher'));
    }

    public function setuju(Request $request)
    {
        $reservasi_mobil = ReservasiMobil::find($request->id_reservasi);

        if($reservasi_mobil->id_status == 1){
            $reservasi_mobil->update([

                'id_status' => 2,
                'komentar_atasan' => $request->komentar,
    
            ]);
            $umum = User::whereHas('roles', function($query) {
                $query->where('name', 'Admin Umum');
            })->where('id_entitas', $reservasi_mobil->id_entitas)->first();
            $wa = new WhatsappNotifikasiController();
            $wa->sendMessageApprove($reservasi_mobil, $umum);
    
            // log activity
            activity()->log('Reservasi Disetujui oleh Atasan ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi berhasil diproses', 'success')->timerProgressBar();
        }elseif($reservasi_mobil->id_status == 2){
            if($request->id_status == 3){
                $reservasi_mobil->update([
                    'id_status' => $request->id_status,
                    'id_pengantaran' => $request->id_pengantaran,
                    'komentar_umum' => $request->komentar
                ]);
            }elseif ($request->id_status == 4){
                $reservasi_mobil->update([
                    'id_status' => $request->id_status,
                    'komentar_umum' => $request->komentar,
                    'id_mobil' => null,
                    'id_supir' => null,
                    'id_jenis_kendaraan' => null,
                    'id_pengantaran' => 3
                ]);
            }

            $kaPool = User::whereHas('roles', function($query) {
                $query->where('name', 'Admin Driver');
            })->where('id_entitas', $reservasi_mobil->id_entitas)->first();
            $wa = new WhatsappNotifikasiController();
            $wa->sendMessageApprove($reservasi_mobil, $kaPool);

            // log activity
            activity()->log('Melakukan Update Reservasi Mobil pada ID: ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi dengan Kode Pemesanan : #'. $reservasi_mobil->kode_pemesanan .' Telah disetujui Umum', 'success')->timerProgressBar();

        }elseif($reservasi_mobil->id_status == 3){
            $reservasi_mobil->update([
                'id_status' => 14,
                'id_jenis_kendaraan' => $request->id_jenis_kendaraan,
                'id_mobil' => $request->id_mobil,
                'id_supir' => $request->id_supir,
                'komentar_supir' => $request->komentar
            ]);
            
            $user = User::find($reservasi_mobil->id_user);
            $driver = Supir::find($reservasi_mobil->id_supir);
            $wa = new WhatsappNotifikasiController();
            $wa->sendMessage($reservasi_mobil, $user);
            $wa->sendMessageDriver($reservasi_mobil, $driver);

            // log activity
            activity()->log('Melakukan Approve Reservasi Mobil pada ID: ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi dengan ID : '. $reservasi_mobil->id .' Telah disetujui Kepala Pool', 'success')->timerProgressBar();
        }elseif($reservasi_mobil->id_status == 4){
            if (!empty($request->nama_voucher)) {
                TransaksiVoucher::where('id_reservasi', $reservasi_mobil->id)->delete();
                foreach ($request->nama_voucher as $row) {
                    if ($row) {
                        TransaksiVoucher::create([
                            'id_reservasi' => $reservasi_mobil->id,
                            'nama_voucher' => $row,
                        ]);
                    }
                }
            }
            $reservasi_mobil->update([
                'id_status' => 5,
                'komentar_supir' => $request->komentar
            ]);
            $user = User::find($reservasi_mobil->id_user);
            $wa = new WhatsappNotifikasiController();
            $wa->sendMessage($reservasi_mobil, $user);

            // log activity
            activity()->log('Melakukan Approve Reservasi Mobil pada ID: ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi dengan ID : '. $reservasi_mobil->id .' Telah disetujui Kepala Pool', 'success')->timerProgressBar();
        }
        return redirect(url('reservasi-mobil'));
    }

    public function actionDriver(Request $request)
    {
        $reservasi_mobil = ReservasiMobil::find($request->id);
        if($reservasi_mobil->id_status == 14){
            $request->merge(['id_status' => 13]);
            $reservasi_mobil->update($request->all());
            // log activity
            activity()->log('Melakukan Perjalanan Kode Pemesanan : #' . $reservasi_mobil->kode_pemesanan);
            toast('Perjalanan Reservasi dengan kode pemesanan : #'. $reservasi_mobil->kode_pemesanan .' Telah dimulai oleh Driver', 'success')->timerProgressBar();
        }else{
            $request->merge(['id_status' => 5]);
            $reservasi_mobil->update($request->all());
            // log activity
            activity()->log('Melakukan Penyelesaian Reservasi dengan Kode Pemesanan : #' . $reservasi_mobil->kode_pemesanan);
            toast('Perjalanan Reservasi dengan Kode Pemesanan : #'. $reservasi_mobil->kode_pemesanan .' telah selesai, Terima Kasih. Semoga Sehat Selalu', 'success')->timerProgressBar();
        }
        return redirect(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan));
    }

    public function batal(Request $request)
    {
        $reservasi_mobil = ReservasiMobil::find($request->id);
        if($reservasi_mobil->id_status == 1){
            $reservasi_mobil->update(['id_status' => 6, 'komentar_atasan' => $request->catatan]);
        }else if($reservasi_mobil->id_status == 2){
            $reservasi_mobil->update(['id_status' => 7, 'komentar_umum' => $request->catatan]);
        }else{
            if($reservasi_mobil->id_status == 14){
                $reservasi_mobil->update([
                    'id_status' => 3,
                    'id_supir' => null,
                    'id_mobil' => null,
                    'id_jenis_kendaraan' => null,
                    'id_pengantaran' => null,
                    'komentar_supir' => $request->catatan
                ]);
            }else{
                $reservasi_mobil->update(['id_status' => $request->id_status, 'komentar_supir' => $request->catatan]);
            }
        }
        // log activity
        activity()->log('Melakukan Pembatalan Reservasi dengan Kode Pemesanan : #' . $reservasi_mobil->kode_pemesanan);
        toast('Reservasi dengan Kode Pemesanan : #'. $reservasi_mobil->kode_pemesanan .' berhasil dibatalkan, Terima Kasih. Info Lebih Lanjut Hubungi Tim Umum atau KA Pool Driver', 'success')->timerProgressBar();
        return redirect(url('reservasi-mobil'));
    }

    public function rating(Request $request, $reservasi_mobil)
    {
        $reservasi_mobil = ReservasiMobil::find($reservasi_mobil);
        $reservasi_mobil->update([
            'rating_driver' => $request->rating_driver,
            'review_driver' => $request->review_driver,
            'flag_rating' => 1,
        ]);
        activity()->log('Melakukan Rating Reservasi dengan Kode Pemesanan : #' . $reservasi_mobil->kode_pemesanan);
        toast('Reservasi dengan Kode Pemesanan : #'. $reservasi_mobil->kode_pemesanan .' berhasil direview, Terima Kasih. Info Lebih Lanjut Hubungi Tim Umum', 'success')->timerProgressBar();
        return redirect(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan));
    }
}
