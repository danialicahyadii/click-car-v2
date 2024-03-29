<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeHelper
{
    /*
     * Get Top Users By Reservations
     * */
    public static function getTopUsersByReservations($limit = 10, $filterType = null, $month = null)
    {
        // Mengambil tanggal hari ini
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();

        // Inisialisasi tanggal awal sesuai dengan jenis filter yang diberikan
        if ($filterType === 'YTD') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now();
            // Lakukan sesuatu dengan rentang tanggal ini
        } elseif ($filterType === 'MTD') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now();
            // Lakukan sesuatu dengan rentang tanggal ini
        } elseif ($filterType === 'ByMonth') {
            $month = Carbon::parse("1 " . $month)->format('m');
            $startDate = Carbon::now()->startOfMonth()->month($month);
            $endDate = Carbon::now()->endOfMonth()->month($month);
        }

        $topPenumpangs = User::join('penumpang', 'penumpang.id_user', '=', 'users.id')
        ->join('reservasi_mobils','penumpang.id_reservasi','=','reservasi_mobils.id')
        ->select('users.*', DB::raw('COUNT(users.id) as reservation_count'))
        ->whereBetween('reservasi_mobils.created_at', [$startDate, $endDate])
        ->groupBy('users.id');
        if (Auth::user()->roles->first()->name == 'Requester') {
            $topPenumpangs->where('reservasi_mobils.id_user', Auth::user()->id);
        }
            $topPenumpangs->orderByDesc('reservation_count')
            ->limit($limit)
            ->get();
            $topPenumpangs = $topPenumpangs->get();

        return $topPenumpangs;
    }
}
