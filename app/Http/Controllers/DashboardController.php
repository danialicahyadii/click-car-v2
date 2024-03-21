<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->roles->first()->name;
        $setuju = ReservasiMobil::where('id_entitas', Auth::user()->id_entitas)
            ->where('id_mobil', '!=', '');
        $today = date('Y-m-d', strtotime(Carbon::now()));
        $booking = ReservasiMobil::where('id_entitas', Auth::user()->id_entitas)
        ->where(function ($q) use ($today){
            $q->where('tgl_pergi', $today);
            $q->orWhere('tgl_pulang', $today);
        })
        ->where('id_status', 13)
        ->count();
        $count_mobil = Mobil::where('id_entitas', Auth::user()->id_entitas)
            ->where('id_status', 8)
            ->whereNull('id_plant')
            ->orderBy('nama', 'ASC')->count();
        $title = 'Dashboard';
        $data['reservasi-mobil'] = ReservasiMobil::count();
        if($role == 'Admin Driver' || $role == 'Driver'){
            return view('apps.dashboard.home');
        }
        if($role == 'Requester' ){
            $setuju->where('id_user', Auth::user()->id);
        }
        $setuju = $setuju->count();
        return view('apps.dashboard.dash', compact('title', 'data', 'booking', 'count_mobil', 'setuju'));
    }

    public function getFilterBulan()
    {
        return 'ini filter bulan';
    }
}
