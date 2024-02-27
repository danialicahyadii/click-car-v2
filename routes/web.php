<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProcessingDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiMobilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SetTitle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/loginsso-v3', [SSOController::class, 'loginSSO']);
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(SetTitle::class . ':Profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('users', UserController::class)->middleware(SetTitle::class . ':Users');
    Route::resource('roles', RoleController::class)->middleware(SetTitle::class . ':Roles');
    Route::resource('permissions', PermissionController::class)->middleware(SetTitle::class . ':Permissions');
    Route::resource('mobil', MobilController::class)->middleware(SetTitle::class . ':Mobil');
    Route::resource('supir', SupirController::class)->middleware(SetTitle::class . ':Supir');
    Route::get('activity-log', [ActivityLogController::class, 'index'])->middleware(SetTitle::class . ':Activity Log');

    Route::prefix('dashboard')->group(function () {
        Route::post('/home/filter-bulan', [DashboardController::class, 'getFilterBulan']);
    })->middleware(SetTitle::class . ':Dashboard');

    Route::prefix('reservasi-mobil')->group(function () {
        Route::get('/', [ReservasiMobilController::class, 'index'])->middleware(SetTitle::class . ':Reservasi Mobil');
        Route::get('/create', [ReservasiMobilController::class, 'create'])->middleware(SetTitle::class . ':Create');
        Route::get('edit/{id}', [ReservasiMobilController::class, 'edit']);
        Route::post('store', [ReservasiMobilController::class, 'store']);
        Route::post('update/{id}', [ReservasiMobilController::class, 'update']);
        Route::delete('{id}', [ReservasiMobilController::class, 'destroy']);
        Route::get('show/{id}', [ReservasiMobilController::class, 'show']);
        Route::get('delete/{id}', [ReservasiMobilController::class, 'destroy']);
        Route::get('/konfirmasi_reservasi', [ReservasiMobilController::class, 'konfirmasi_reservasi']);
        Route::get('print_surat_jalan/{id}', [ReservasiMobilController::class, 'printSuratJalan']);
        Route::get('/dibatalkan/{id}', [ReservasiMobilController::class, 'dibatalkan']);

        Route::get('get-available-car', [ProcessingDataController::class, 'getAvailableCar']);
        // Route::get('get-cars', [ProcessingDataController::class, 'getCars']);
        // Route::get('get-available-drivers', [ProcessingDataController::class, 'getAvailableDrivers']);

        //TAB TAB
        Route::get('/telah-disetujui', [ReservasiMobilController::class, 'telahDisetujui']);
        Route::get('/reservasi-selesai', [ReservasiMobilController::class, 'reservasiSelesai']);
        Route::get('/reservasi-ditolak', [ReservasiMobilController::class, 'reservasiDitolak']);
        Route::get('/riwayat', [ReservasiMobilController::class, 'riwayat']);
        Route::get('/hari-ini', [ReservasiMobilController::class, 'hariIni']);

        //Umum Approve
        Route::post('setuju-admin-umum/{id}', [ReservasiMobilController::class, 'setujuUmum']);

        //Atasan approve
        Route::post('/setuju', [ReservasiMobilController::class, 'setuju']);
        Route::post('/tolak', [ReservasiMobilController::class, 'tolak']);

        //SUPIR
        Route::post('setuju-admin-driver/{id}', [ReservasiMobilController::class, 'setujuDriver']);
        Route::post('/start', [ReservasiMobilController::class, 'startDriver']);
        Route::post('/selesai', [ReservasiMobilController::class, 'selesaiDriver']);
        Route::post('/dibatalkan-driver/{id}', [ReservasiMobilController::class, 'dibatalkanDriver']);
        // Route::post('/draft-supir', [ReservasiMobilController::class, 'draftSupir']);
    });
});

require __DIR__ . '/auth.php';
