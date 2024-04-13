<?php

namespace App\Helpers;

use App\Models\Mobil;
use App\Models\ReservasiMobil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarHelper
{
    /*
     * Get all available cars
     * */
    public static function getAvailableCars($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd)
    {
        // Dapatkan semua mobil yang dimiliki oleh entitas
        $cars = Mobil::where('id_entitas', Auth::user()->id_entitas)->where('id_status', '!=', 9)->orderBy('nama', 'ASC')->get();

        // Buat objek yang akan menampung mobil yang akan ditampilkan
        $displayCars = new \stdClass;

        foreach ($cars as $car) {
            // Default status
            $status = 'Available';

            // Cari reservasi yang tumpang tindih dengan rentang tanggal pergi dan tanggal pulang
            $overlappingReservations = ReservasiMobil::where('id_mobil', $car->id)
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
            // Jika ada reservasi yang tumpang tindih, atur status menjadi "Not Available"
            if ($overlappingReservations > 0) {
                $status = 'Not Available';
            }

            // Tambahkan mobil ke objek dengan id_plat, nomor_plat, nama, dan status yang sesuai
            $displayCars->{$car->id} = new \stdClass;
            $displayCars->{$car->id}->id = $car->id;
            $displayCars->{$car->id}->nama = $car->nama;
            $displayCars->{$car->id}->id_plat = $car->id_plat;
            $displayCars->{$car->id}->nomor_plat = $car->Plat->nomor_plat;
            $displayCars->{$car->id}->status = $status;
            $displayCars->{$car->id}->jns_kendaraan = $car->id_jenis_kendaraan;
        }

        // Sekarang $displayCars berisi objek dengan id sebagai kunci
        return $displayCars;
    }

    /*
     * Get available cars count
     * */
    public static function getAvailableCarsCount($tanggalPergi, $tanggalPulang, $timeStart, $timeEnd)
    {
        // Dapatkan semua mobil yang dimiliki oleh entitas
        $cars = Mobil::where('id_entitas', Auth::user()->id_entitas)->where('id_status', '!=', 9)->orderBy('nama', 'ASC')->get();

        // Inisialisasi hitungan mobil tersedia dan tidak tersedia
        $availableCount = 0;
        $notAvailableCount = 0;

        foreach ($cars as $car) {
            // Default status
            $status = 'Available';
            // Cari reservasi yang tumpang tindih dengan rentang tanggal pergi dan tanggal pulang
            $overlappingReservations = ReservasiMobil::where('id_mobil', $car->id)
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

            // Jika ada reservasi yang tumpang tindih, mobil dianggap "Not Available"
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
    *  Get Top Mobil By Reservations
    * */
    public static function getTopVehiclesByReservations($limit = 10, $filterType = null, $month = null)
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
        $topCars = DB::table('master_mobil')
        ->join('reservasi_mobil', 'master_mobil.id', '=', 'reservasi_mobil.id_mobil')
        ->join('master_entitas', 'reservasi_mobil.id_entitas', '=', 'master_entitas.id')
        ->select('master_mobil.*', 'master_entitas.nama as nama_entitas', DB::raw('COUNT(reservasi_mobil.id) as reservation_count'))
        ->whereBetween('reservasi_mobil.created_at', [$startDate, $endDate])
        ->groupBy('master_mobil.id', 'master_entitas.nama');
        if(Auth::user()->roles->first()->name == 'Requester') {
            $topCars->where('reservasi_mobil.id_user', Auth::user()->id);
        }
        $topCars->orderByDesc('reservation_count')
        ->limit($limit);
        
        $topCars = $topCars->get();
        
        return $topCars;
    }
    public static function getCars()
    {
        // Dapatkan semua mobil yang dimiliki oleh entitas
        $cars = Mobil::where('id_entitas', Auth::user()->id_entitas)->where('id_status', '!=', 9)->orderBy('nama', 'ASC')->get();

        // Buat objek yang akan menampung mobil yang akan ditampilkan
        $displayCars = new \stdClass;

        foreach ($cars as $car) {
            // Tambahkan mobil ke objek dengan id_plat, nomor_plat, nama, dan status yang sesuai
            $displayCars->{$car->id} = new \stdClass;
            $displayCars->{$car->id}->id = $car->id;
            $displayCars->{$car->id}->id_plat = $car->id_plat;
            $displayCars->{$car->id}->nomor_plat = $car->Plat->nomor_plat;
            $displayCars->{$car->id}->nama = $car->nama;
            $displayCars->{$car->id}->jns_kendaraan = $car->id_jenis_kendaraan;
        }

        // Sekarang $displayCars berisi objek dengan id sebagai kunci
        return $displayCars;
    }
}
