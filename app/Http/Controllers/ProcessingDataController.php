<?php

namespace App\Http\Controllers;

use App\Helpers\CarHelper;
use App\Helpers\DriverHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProcessingDataController extends Controller
{
    public function getAvailableCar(Request $request)
    {
        $dataCar = [];
        $mobil = CarHelper::getAvailableCars($request->tgl_pergi, $request->tgl_pulang, $request->time_start, $request->time_end);

        foreach ($mobil as $key) {
            if ($key->jns_kendaraan == $request->carOption) {
                $dataCar[] = $key;
            }
        }
        $datePergi = Carbon::parse($request->tgl_pergi)->day;
        if (!empty(($datePergi % 2))) {
            $statusDate = 'Hari ini ganjil';
        } else {
            $statusDate = 'Hari ini genap';
        }

        return response()->json([
            'status' => 'success',
            'data' => $dataCar,
            'statusDate' => $statusDate,
        ]);
    }

    public function getAvailableDrivers(Request $request)
    {
        $dataDrivers = [];
        $supir = DriverHelper::requestAvailableDrivers($request->tgl_pergi, $request->tgl_pulang, $request->time_start, $request->time_end);

        foreach ($supir as $key) {
            $dataDrivers[] = $key;
        }
        return response()->json([
            'status' => 'success',
            'data' => $dataDrivers,
        ]);
    }
}
