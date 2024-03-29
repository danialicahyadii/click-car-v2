<?php

namespace App\Http\Controllers;

use App\Helpers\CarHelper;
use App\Helpers\DriverHelper;
use App\Helpers\EmployeeHelper;
use App\Helpers\LocationHelper;
use App\Models\Mobil;
use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $booking_show = ReservasiMobil::where('id_entitas', Auth::user()->id_entitas)
            ->where(function ($q) use ($today){
                $q->where('tgl_pergi', $today);
                $q->orWhere('tgl_pulang', $today);
            })->whereNot('id_pengantaran', 3);
        if(Auth::user()->roles->first()->name == 'Requester'){
            $booking_show->where('id_user', Auth::user()->id);
        }
        $booking_show = $booking_show->get();
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
        $optionSeries = $this->getOptionSeries(5);
        $reservasi = ReservasiMobil::select('rating_driver')
        ->whereNotNull('rating_driver')
        ->get();
        $rating = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        foreach ($reservasi as $reservation) {
            $ratingCounts = $reservation->rating_driver;
            $rating[$ratingCounts]++;
        }
        $topDrivers = DriverHelper::getTopFavoriteDrivers(10);
        $topVehicles = CarHelper::getTopVehiclesByReservations(10);
        $topUsers = EmployeeHelper::getTopUsersByReservations(10);
        $topLocation = LocationHelper::getTopFavoriteLocations(10);
        return view('apps.dashboard.dash', compact('title', 'rating', 'data', 'booking', 'count_mobil', 'setuju', 'optionSeries', 'booking_show', 'topDrivers', 'topVehicles', 'topUsers', 'topLocation'));
    }

    public function getOptionSeries($limit = 5, $filterType = null, $month = null)
    {
        $topUsers = EmployeeHelper::getTopUsersByReservations($limit, $filterType, $month);
        $topVehicles = CarHelper::getTopVehiclesByReservations($limit, $filterType, $month);
        $topDrivers = DriverHelper::getTopFavoriteDrivers($limit, $filterType, $month);
        // kondisi driver terfavorit jika yg baru masih sedikit
        // if (count($topDrivers) <= 5) {
        //     $topDrivers = DriverHelper::getTopFavoriteDriversOld($limit, $filterType, $month);
        // }

        // Extract data reservation_count menjadi array terpisah
        $driverCounts = $topDrivers->pluck('reservation_count')->toArray();
        $vehicleCounts = $topVehicles->pluck('reservation_count')->toArray();
        $employeeCounts = $topUsers->pluck('reservation_count')->toArray();

        // Extract data nama menjadi array terpisah
        $drivers = $topDrivers->pluck('nama')->toArray();
        $vehicles = $topVehicles->pluck('nama')->toArray();
        $employees = $topUsers->pluck('name')->toArray();

        $options = [
            'series' => [
                [
                    'name' => 'Driver',
                    'data' => $driverCounts,
                    'labels' => $drivers,
                ],
                [
                    'name' => 'Kendaraan',
                    'data' => $vehicleCounts,
                    'labels' => $vehicles,
                ],
                [
                    'name' => 'Karyawan',
                    'data' => $employeeCounts,
                    'labels' => $employees,
                ],
            ],
        ];

        return $options;
    }

    public function getFilterBulan(Request $request)
    {
        $filterType = $request->filter_type;
        $month = $request->month;
        switch ($filterType) {
            case 'YTD':
                // Logika untuk filter Year to Date
                $optionSeries = $this->getOptionSeries(10, $filterType);
                break;
            case 'MTD':
                // Logika untuk filter Month to Date
                $optionSeries = $this->getOptionSeries(10, $filterType);
                break;
            case 'ByMonth':
                // Logika untuk filter bulan Januari
                $optionSeries = $this->getOptionSeries(10, $filterType, $month);
                break;
        }

        return $optionSeries;
    }
}
