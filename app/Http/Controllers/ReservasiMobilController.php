<?php

namespace App\Http\Controllers;

use App\Models\JenisKendaraan;
use App\Models\Mobil;
use App\Models\ReservasiMobil;
use App\Models\Supir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiMobilController extends Controller
{

    public function data(){
        $data['penumpang'] = User::where('kode_entitas', Auth::user()->kode_entitas)->orderBy('name', 'ASC')->get();
        $data['atasan'] = User::whereIn('kode_jabatan', [Auth::user()->approval_1, Auth::user()->approval_2, Auth::user()->approval_3])->orderBy('level_jabatan', 'DESC')->get();
        // dd($data['atasan']);
        $data['jenis_kendaraan'] = JenisKendaraan::orderBy('nama', 'ASC')->get();
        $data['mobil'] = Mobil::where('id_entitas', Auth::user()->id_entitas)->orderBy('nama', 'ASC')->get();
        $data['supir'] = Supir::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->orderBy('nama', 'ASC')->get();

        return $data;
    }

    public function index()
    {
        $role = Auth::user()->roles->first()->name;
        $year = Carbon::now()->year;
        $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->get();
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
        
        $reservasi_mobil = ReservasiMobil::create($request->all());

        return redirect()->back();
    }
}
