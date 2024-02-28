<?php

namespace App\Helpers;

use App\Models\Mobil;
use App\Models\ReservasiMobil;
use App\Models\Supir;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverHelper
{
    /*
     * Get all available drivers
     * */
    public static function getAvailableDrivers($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd)
    {
        // Dapatkan semua supir yang tersedia
        $drivers = Supir::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->orderBy('nama', 'ASC')->get();

        // Buat objek yang akan menampung supir yang akan ditampilkan
        $displayDrivers = new \stdClass;

        foreach ($drivers as $driver) {
            // Default status
            $status = 'Available';

            // Cari reservasi yang tumpang tindih dengan rentang tanggal pergi dan tanggal pulang
            $overlappingReservations = ReservasiMobil::where('id_supir', $driver->id)
                ->where(function ($query) use ($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd) {
                    $query->where(function ($q) use ($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd) {
                        $q->where(function ($innerQuery) use ($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd) {
                            $innerQuery->where(function ($dateQuery) use ($tanggalPergi, $tanggalPulang) {
                                $dateQuery->whereBetween('tgl_pergi', [$tanggalPergi, $tanggalPulang])
                                    ->orWhereBetween('tgl_pulang', [$tanggalPergi, $tanggalPulang]);
                            })->where(function ($timeQuery) use ($timeStart, $timeEnd) {
                                $timeQuery->whereBetween('wktu_pergi', [$timeStart, $timeEnd])
                                    ->orWhereBetween('wktu_plng', [$timeStart, $timeEnd]);
                            });
                        });
                    });
                })
                ->where('id_status', 13)
                ->count();

            // Jika ada reservasi yang tumpang tindih, supir dianggap "Not Available"
            if ($overlappingReservations > 0) {
                $status = 'Not Available';
            }

            // Tambahkan supir ke objek dengan id dan status yang sesuai
            $displayDrivers->{$driver->id} = new \stdClass;
            $displayDrivers->{$driver->id}->id = $driver->id;
            $displayDrivers->{$driver->id}->nama = $driver->nama;
            $displayDrivers->{$driver->id}->status = $status;
        }

        // Sekarang $displayDrivers berisi objek dengan id sebagai kunci
        return $displayDrivers;
    }

    /*
     * Get all available drivers
     * */
    public static function requestAvailableDrivers($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd)
    {
        // Dapatkan semua supir yang tersedia
        $drivers = Supir::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->orderBy('nama', 'ASC')->get();

        // Buat objek yang akan menampung supir yang akan ditampilkan
        $displayDrivers = new \stdClass;

        foreach ($drivers as $driver) {
            // Default status
            $status = 'Available';

            // Cari reservasi yang tumpang tindih dengan rentang tanggal pergi dan tanggal pulang
            $overlappingReservations = ReservasiMobil::where('id_supir', $driver->id)
                ->where(function ($query) use ($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd) {
                    $query->where(function ($q) use ($tanggalPergi, $tanggalPulang) {
                        $q->whereBetween('tgl_pergi', [$tanggalPergi, $tanggalPulang])
                            ->orWhereBetween('tgl_pulang', [$tanggalPergi, $tanggalPulang]);
                    })
                        ->orWhere(function ($q) use ($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd) {
                            $q->where('tgl_pergi', $tanggalPergi)
                                ->where('tgl_pulang', $tanggalPulang)
                                ->where(function ($innerQuery) use ($timeStart, $timeEnd) {
                                    $innerQuery->whereBetween('wktu_pergi', [$timeStart, $timeEnd])
                                        ->orWhereBetween('wktu_plng', [$timeStart, $timeEnd]);
                                });
                        });
                })
                ->where('id_status', 13)
                ->count();
            // Jika ada reservasi yang tumpang tindih, supir dianggap "Not Available"
            if ($overlappingReservations > 0) {
                $status = 'Not Available';
            }

            // Tambahkan supir ke objek dengan id dan status yang sesuai
            $displayDrivers->{$driver->id} = new \stdClass;
            $displayDrivers->{$driver->id}->id = $driver->id;
            $displayDrivers->{$driver->id}->nama = $driver->nama;
            $displayDrivers->{$driver->id}->status = $status;
        }

        // Sekarang $displayDrivers berisi objek dengan id sebagai kunci
        return $displayDrivers;
    }

    /*
     * Get available drivers count
     * */
    public static function getAvailableDriversCount($tanggalPergi, $tanggalPulang)
    {
        // Dapatkan semua supir yang tersedia
        $drivers = Supir::where('id_entitas', Auth::user()->id_entitas)->where('id_status', 1)->orderBy('nama', 'ASC')->get();

        // Inisialisasi hitungan supir tersedia dan tidak tersedia
        $availableCount = 0;
        $notAvailableCount = 0;

        foreach ($drivers as $driver) {
            // Default status
            $status = 'Available';

            // Cari reservasi yang tumpang tindih dengan rentang tanggal pergi dan tanggal pulang
            $overlappingReservations = ReservasiMobil::where('id_supir', $driver->id)
                ->where(function ($query) use ($tanggalPergi, $tanggalPulang) {
                    $query->whereBetween('tgl_pergi', [$tanggalPergi, $tanggalPulang])
                        ->orWhereBetween('tgl_pulang', [$tanggalPergi, $tanggalPulang]);
                })
                ->where('id_status', 13)
                ->count();

            // Jika ada reservasi yang tumpang tindih, supir dianggap "Not Available"
            if ($overlappingReservations > 0) {
                $status = 'Not Available';
                $notAvailableCount++;
            } else {
                $availableCount++;
            }
        }

        return [
            'availableCount' => $availableCount,
            'notAvailableCount' => $notAvailableCount,
        ];
    }

    /*
     * Get Favorite Driver new
     * */
    public static function getTopFavoriteDrivers($limit = 10, $filterType = null, $month = null)
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
            // Lakukan sesuatu dengan rentang tanggal ini
        }

        // Lakukan pencarian driver dengan rating tertinggi di RatingLog.
        $topDrivers = DB::table('supirs')
            ->join('rating_driver', 'supirs.id', '=', 'rating_driver.id_supir')
            ->join('entitas', 'supirs.id_entitas', '=', 'entitas.id')
            ->select('supirs.*', 'rating_driver.*', 'entitas.nama as nama_entitas', DB::raw('MAX(rating_driver.rating) as highest_rating'), DB::raw('COUNT(rating_driver.id) as reservation_count'))
            ->whereBetween('rating_driver.created_at', [$startDate, $endDate]);
        if (Auth::user()->roles->first()->name == 'Requester') {
            $topDrivers->where('rating_driver.created_by', Auth::user()->id);
        }
        if (Auth::user()->roles->first()->name == 'Approval') {
            $topDrivers->where('rating_driver.created_by', Auth::user()->id);
        }

        $topDrivers->groupBy('supirs.id')
            ->orderByDesc('highest_rating')
            ->limit($limit);
        $topDrivers = $topDrivers->get();
        return $topDrivers;
    }

    /*
     * Get Favorite Driver old
     * */
    public static function getTopFavoriteDriversOld($limit = 10, $filterType = null, $month = null)
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

        $topDrivers = Supir::leftJoin('reservasi_mobils', 'supirs.id', '=', 'reservasi_mobils.id_supir')
            ->select('supirs.*', DB::raw('MAX(reservasi_mobils.id_rating) as highest_rating'))
            ->selectRaw('COUNT(reservasi_mobils.id) as reservation_count')
            ->whereBetween('reservasi_mobils.created_at', [$startDate, $endDate])
            ->groupBy('supirs.id')
            ->orderByDesc('reservation_count')
            ->limit($limit)
            ->get();

        return $topDrivers;
    }
}
