<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

    Route::post('/home/filter-bulan', [DashboardController::class, 'getFilterBulan']);

    Route::resource('users', UserController::class)->middleware(SetTitle::class . ':Users');
    Route::resource('roles', RoleController::class)->middleware(SetTitle::class . ':Roles');
    Route::resource('permissions', PermissionController::class)->middleware(SetTitle::class . ':Permissions');
});

require __DIR__ . '/auth.php';
