<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard.dash', compact('title'));
    }

    public function getFilterBulan()
    {
        return 'ini filter bulan';
    }
}
