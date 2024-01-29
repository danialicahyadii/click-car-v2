<?php

namespace App\Http\Controllers;

use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasiMobilController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;
        $reservasi_mobil = ReservasiMobil::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->get();
        return view('reservasi-mobil.index', compact('reservasi_mobil'));
    }

    public function create()
    {
        return view('reservasi-mobil.create');
    }
}
