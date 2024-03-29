<?php

namespace App\Helpers;

use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationHelper
{
    /*
     * Get Top Favorite Locations
     */
    public static function getTopFavoriteLocations($limit = 10, $filterType = null)
    {
        // Mengambil tanggal hari ini
        $endDate = Carbon::now();

        // Inisialisasi tanggal awal sesuai dengan jenis filter yang diberikan
        if ($filterType === 'YTD' || $filterType === null) {
            // Filter Year to Date (YTD) dari 1 Januari hingga saat ini
            $startDate = Carbon::now()->startOfYear();
        } elseif ($filterType === 'MTD') {
            // Filter Month to Date (MTD) dari awal bulan hingga saat ini
            $startDate = Carbon::now()->startOfMonth();
        } else {
            // Jika jenis filter tidak valid, gunakan tanggal awal tahun ini sebagai default
            $startDate = Carbon::now()->startOfYear();
        }

        $topLocations = ReservasiMobil::select('tujuan', DB::raw('COUNT(id) as location_count'), 'id_user')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('tujuan', 'id_user')
        ->orderByDesc('location_count')
        ->limit($limit);
        if(Auth::user()->roles->first()->name == 'Requester'){
            $topLocations->where('id_user', Auth::user()->id);
        }
        $topLocations = $topLocations->get();
        return $topLocations;
    }
}
