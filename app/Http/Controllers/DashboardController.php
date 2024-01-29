<?php

namespace App\Http\Controllers;

use App\Models\ReservasiMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $data['reservasi-mobil'] = ReservasiMobil::count();
        return view('dashboard.dash', compact('title', 'data'));
    }

    public function getFilterBulan()
    {
        return 'ini filter bulan';
    }
}
