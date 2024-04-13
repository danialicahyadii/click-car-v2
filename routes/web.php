<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ChecklistKendaraanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemInspeksiController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProcessingDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiMobilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SSOController;
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
Route::get('/loginsso-v3', [SSOController::class, 'loginSSO']);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified', SetTitle::class . ':Dashboard'])->name('dashboard');
    Route::prefix('dashboard')->middleware(SetTitle::class . ':Dashboard')->group(function () {
        Route::post('/filter-bulan', [DashboardController::class, 'getFilterBulan']);
    });

    Route::prefix('reservasi-mobil')->middleware(SetTitle::class . ':Reservasi Mobil')->group(function () {
        Route::get('/', [ReservasiMobilController::class, 'index']);
        Route::get('/create', [ReservasiMobilController::class, 'create']);
        Route::get('edit/{id}', [ReservasiMobilController::class, 'edit']);
        Route::post('store', [ReservasiMobilController::class, 'store']);
        Route::post('update/{id}', [ReservasiMobilController::class, 'update']);
        Route::delete('{id}', [ReservasiMobilController::class, 'destroy']);
        Route::get('show/{kode_pemesanan}', [ReservasiMobilController::class, 'show']);
        Route::post('/batal/{id}', [ReservasiMobilController::class, 'batal']);
        Route::post('/rating/{id}', [ReservasiMobilController::class, 'rating']);
        Route::get('delete/{id}', [ReservasiMobilController::class, 'destroy']);
        Route::get('/konfirmasi_reservasi', [ReservasiMobilController::class, 'konfirmasi_reservasi']);
        Route::get('print_surat_jalan/{id}', [ReservasiMobilController::class, 'printSuratJalan']);

        Route::get('get-available-car', [ProcessingDataController::class, 'getAvailableCar']);
        Route::get('get-available-drivers', [ProcessingDataController::class, 'getAvailableDrivers']);
        // Route::get('get-cars', [ProcessingDataController::class, 'getCars']);

        //approve
        Route::post('/setuju', [ReservasiMobilController::class, 'setuju']);
        Route::post('/tolak', [ReservasiMobilController::class, 'tolak']);

        //start driver
        Route::post('/action-driver', [ReservasiMobilController::class, 'actionDriver']);
        
        //TAB TAB
        Route::get('/telah-disetujui', [ReservasiMobilController::class, 'telahDisetujui']);
        Route::get('/reservasi-selesai', [ReservasiMobilController::class, 'reservasiSelesai']);
        Route::get('/reservasi-ditolak', [ReservasiMobilController::class, 'reservasiDitolak']);
        Route::get('/riwayat', [ReservasiMobilController::class, 'riwayat']);
        Route::get('/hari-ini', [ReservasiMobilController::class, 'hariIni']);

        //Umum Approve
        Route::post('setuju-admin-umum/{id}', [ReservasiMobilController::class, 'setujuUmum']);


        //SUPIR
        Route::post('setuju-admin-driver/{id}', [ReservasiMobilController::class, 'setujuDriver']);
        Route::post('/start', [ReservasiMobilController::class, 'startDriver']);
        Route::post('/selesai', [ReservasiMobilController::class, 'selesaiDriver']);
        Route::post('/dibatalkan-driver/{id}', [ReservasiMobilController::class, 'dibatalkanDriver']);
        // Route::post('/draft-supir', [ReservasiMobilController::class, 'draftSupir']);
    });

    Route::prefix('checklist-kendaraan')->middleware(SetTitle::class . ':Checklist Kendaraan')->group(function () {
        Route::get('/', [ChecklistKendaraanController::class, 'index']);
        Route::get('create/{id}', [ChecklistKendaraanController::class, 'create']);
        Route::post('store', [ChecklistKendaraanController::class, 'store']);
        Route::get('show/{id}/{month}/{year}', [ChecklistKendaraanController::class, 'show']);
        Route::get('show-inspeksi/{id}', [ChecklistKendaraanController::class, 'showInspeksi']);
        Route::post('approve/{id}', [ChecklistKendaraanController::class, 'approve']);
        Route::post('return/{id}', [ChecklistKendaraanController::class, 'return']);
        Route::get('edit/{id}', [ChecklistKendaraanController::class, 'edit']);
        Route::post('update/{id}', [ChecklistKendaraanController::class, 'update']);
        Route::get('print/{id}', [ChecklistKendaraanController::class, 'print']);
        Route::get('download/{id}', [ChecklistKendaraanController::class, 'download']);
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware(SetTitle::class . ':Profile');
    Route::get('/profile/edit/{param}', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(SetTitle::class . ':Profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('activity-log', [ActivityLogController::class, 'index'])->middleware(SetTitle::class . ':Activity Log');
    Route::post('/upload-profile-image/{id}', [UserController::class, 'uploadProfileImage']);

    Route::resource('users', UserController::class)->middleware(SetTitle::class . ':Users');
    Route::resource('roles', RoleController::class)->middleware(SetTitle::class . ':Roles');
    Route::resource('permissions', PermissionController::class)->middleware(SetTitle::class . ':Permissions');
    Route::resource('mobil', MobilController::class)->middleware(SetTitle::class . ':Mobil');
    Route::resource('supir', SupirController::class)->middleware(SetTitle::class . ':Supir');
    Route::resource('jenis-kendaraan', JenisKendaraanController::class)->middleware(SetTitle::class . ':Jenis Kendaraan');
    Route::resource('item-inspeksi', ItemInspeksiController::class)->middleware(SetTitle::class . ':Item Inspeksi');
});

require __DIR__ . '/auth.php';
