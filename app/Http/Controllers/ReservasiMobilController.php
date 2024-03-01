<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use App\Models\Mobil;
use App\Models\Penumpang;
use App\Models\ReservasiMobil;
use App\Models\Supir;
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
        $data['penumpang_reservasi'] = Penumpang::get();

        return $data;
    }

    public function index()
    {
        $role = Auth::user()->roles->first()->name;
        $year = Carbon::now()->year;
        if($role == 'Admin Umum'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        }elseif($role == 'Requester'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->where(function ($query) {
                $query->where('id_user', Auth::user()->id)
                    ->orWhere('id_atasan', Auth::user()->id);
                })->orderBy('id', 'desc')->get();
        }elseif($role == 'Admin Driver'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        }elseif($role == 'Driver'){
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->where('id_supir', Auth::user()->supir->id)->orderBy('id', 'desc')->get();
        }else{
            $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        }
        
        return view('apps.reservasi-mobil.index', compact('reservasi_mobil'));
    }

    public function create()
    {
        $data = $this->data();
        $penumpang = $data['penumpang'];
        $atasan = $data['atasan'];
        $jenis_kendaraan = $data['jenis_kendaraan'];
        $mobil = $data['mobil'];
        $supir = $data['supir'];

        return view('apps.reservasi-mobil.create', compact('penumpang', 'atasan', 'jenis_kendaraan', 'mobil', 'supir'));
    }

    public function store(Request $request)
    {
        $dateDeparture = Carbon::create($request->tgl_pergi . $request->wktu_pergi);
        $dateExpired = $dateDeparture->addMinute(30);
        $waktuKeberangkatan = $dateDeparture->subMinute(10);

        $request->merge([
            'id_user' => Auth::user()->id,
            'id_entitas' => Auth::user()->id_entitas,
            'jml_penumpang' => count($request->id_penumpang),
            'id_status' => 1,
            'date_expired' => $dateExpired,
            'waktu_keberangkatan' => $waktuKeberangkatan,
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
        // ini WA
        // $atasan = User::where('id', $request->id_atasan)->first();
        // $this->wa->sendMessageAtasan($atasan, $reservasi_mobil);

        activity()->log('Melakukan Pembuatan Reservasi Mobil dengan ID Pemesanan: ' . $reservasi_mobil->id);
        toast('Permintaan Reservasi ke ' . $reservasi_mobil->tujuan . ' Berhasil!', 'success')->timerProgressBar();

        return redirect(url('reservasi-mobil'));
    }

    public function show($id)
    {
        $data = $this->data();
        $reservasi_mobil = $data['reservasi_mobil']->find($id);
        $penumpang = $data['penumpang_reservasi']->where('id_reservasi', $id);
        $jenis_kendaraan = $data['jenis_kendaraan'];
        $mobil = $data['mobil'];
        $supir = $data['supir'];

        return view('apps.reservasi-mobil.show', compact('reservasi_mobil', 'penumpang', 'jenis_kendaraan', 'mobil', 'supir'));
    }

    public function setuju(Request $request)
    {
        $reservasi_mobil = ReservasiMobil::find($request->id_reservasi);

        if($reservasi_mobil->id_status == 1){
            $reservasi_mobil->update([

                'id_status' => 2,
                'komentar_atasan' => $request->komentar,
    
            ]);
            $user = User::find($reservasi_mobil->id_user);
            //ada notif wa ke umum dan requester
            // $this->wa->sendMessageUmum($reservasi_mobil);
            // $this->wa->sendMessageSetuju($reservasi_mobil, $user);
            // try {
            //     Mail::send('components.approval-atasan(for-admin)', ['reservasi_mobil' => $reservasi_mobil], function ($message) use ($user) {
            //         $message->subject('Clickcar Kimia Farma');
            //         $message->from('clickcar.kaef@gmail.com');
            //         $message->to('andika.ags04@gmail.com');
            //     });
            // } catch (Exception $e) {
            //     return response(['status' => false, 'errors' => $e->getMessage()]);
            // }
    
            // log activity
            activity()->log('Reservasi Disetujui oleh Atasan ' . $reservasi_mobil->tujuan);
            toast('Permintaan Reservasi Telah disetujui atasan', 'success')->timerProgressBar();
        }elseif($reservasi_mobil->id_status == 2){
            if($request->id_status == 3){
                $reservasi_mobil->update([
                    'id_status' => $request->id_status,
                    'komentar_umum' => $request->komentar
                ]);
            }elseif ($request->id_status == 4){
                $reservasi_mobil->update([
                    'id_status' => $request->id_status,
                    'komentar_umum' => $request->komentar,
                    'id_mobil' => null,
                    'id_supir' => null,
                    'id_jenis_kendaraan' => null
                ]);
            }

            // $user = User::find($reservasi_mobil->id_user);
            // $admin_supir = Supir::with('User')->where('id', 130)->first();
            // $this->wa->sendMessageSetuju($reservasi_mobil, $user);
            // $this->wa->sendMessageAdminDriver($reservasi_mobil, $user, $admin_supir);

            // log activity
            activity()->log('Melakukan Update Reservasi Mobil pada ID: ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi dengan ID : '. $reservasi_mobil->id .' Telah disetujui Umum', 'success')->timerProgressBar();

        }elseif($reservasi_mobil->id_status == 3){
            $reservasi_mobil->update([
                'id_status' => 14,
                'id_jenis_kendaraan' => $request->id_jenis_kendaraan,
                'id_mobil' => $request->id_mobil,
                'id_supir' => $request->id_supir,
                'komentar_supir' => $request->komentar
            ]);
            // $user = User::find($reservasi_mobil->id_user);
            // if ($request->id_status == 4) {
            //     $voucher = TransaksiVoucher::where('id_reservasi', $reservasi_mobil->id)->get();
            //     $this->wa->sendMessageGrab($reservasi_mobil, $user, $voucher);
            // } else {
            //     $supir = Supir::with('User')->where('id', $reservasi_mobil->id_supir)->first();
            //     $this->wa->sendMessage($reservasi_mobil, $user);
            //     $this->wa->sendMessageDriver($reservasi_mobil, $user, $supir);
            // }

            // log activity
            activity()->log('Melakukan Approve Reservasi Mobil pada ID: ' . $reservasi_mobil->id);
            toast('Permintaan Reservasi dengan ID : '. $reservasi_mobil->id .' Telah disetujui Kepala Pool', 'success')->timerProgressBar();
        }
        return redirect(url('reservasi-mobil'));
    }
}
