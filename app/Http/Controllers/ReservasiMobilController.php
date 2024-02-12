<?php

namespace App\Http\Controllers;

use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiMobilController extends Controller
{
    public function index()
    {
        $role = Auth::user()->roles->first()->name;
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
