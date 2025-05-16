<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Penyuluh\PenyuluhController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupMenu;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Parameter;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Provinsi;
use App\Http\Controllers\SpeedTestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Usergroups;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('rate.limit')->get('/', [LoginController::class, 'showLoginForm'])->name('Login');

Route::middleware(['auth', 'verified'])
    ->prefix('menu')
    ->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu');
        Route::get('/json', [MenuController::class, 'json'])->name('menu');
        Route::post('/store', [MenuController::class, 'store'])->name('menu');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('menugrup')
    ->group(function () {
        Route::get('/json', [GroupMenu::class, 'json'])->name('menu-group');
        Route::post('/store', [GroupMenu::class, 'store'])->name('menu-group');
        Route::get('/edit/{id}', [GroupMenu::class, 'edit'])->name('menu-group');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('parameter')
    ->group(function () {
        Route::get('/', [Parameter::class, 'index'])->name('parameter');
        Route::get('/json', [Parameter::class, 'json'])->name('parameter');
        Route::get('/edit/{id}', [Parameter::class, 'edit'])->name('parameter');
        Route::post('/store', [Parameter::class, 'store'])->name('parameter');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('provinsi')
    ->group(function () {
        Route::get('/', [Provinsi::class, 'index'])->name('provinsi');
        Route::get('/json', [Provinsi::class, 'json'])->name('provinsi');
        Route::post('/store', [Provinsi::class, 'store'])->name('provinsi');
        Route::get('/edit/{id}', [Provinsi::class, 'edit'])->name('provinsi');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kabupaten')
    ->group(function () {
        Route::get('/', [KabupatenController::class, 'index'])->name('kabupaten');
        Route::get('/json', [KabupatenController::class, 'json'])->name('kabupaten');
        Route::post('/store', [KabupatenController::class, 'store'])->name('kabupaten');
        Route::get('/edit/{id}', [KabupatenController::class, 'edit'])->name('kabupaten');
        Route::get('/search', [KabupatenController::class, 'search'])->name('kelurahan');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kecamatan')
    ->group(function () {
        Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan');
        Route::get('/json', [KecamatanController::class, 'json'])->name('kecamatan');
        Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan');
        Route::get('/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan');
        Route::get('/search', [KecamatanController::class, 'search'])->name('kelurahan');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kelurahan')
    ->group(function () {
        Route::get('/', [KelurahanController::class, 'index'])->name('kelurahan');
        Route::get('/json', [KelurahanController::class, 'json'])->name('kelurahan');
        Route::post('/store', [KelurahanController::class, 'store'])->name('kelurahan');
        Route::get('/edit/{id}', [KelurahanController::class, 'edit'])->name('kelurahan');
        Route::get('/search', [KelurahanController::class, 'search'])->name('kelurahan');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('permission')
    ->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission');
        Route::get('/json', [PermissionController::class, 'json'])->name('permission');
        Route::post('/store', [PermissionController::class, 'store'])->name('permission');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission');
        Route::get('/set-json', [PermissionController::class, 'json2'])->name('permission');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('user-management')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user-management');
        Route::get('/json', [UserController::class, 'json'])->name('user-management');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user-management');
        Route::post('/store', [UserController::class, 'store'])->name('user-management');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('user-groups')
    ->group(function () {
        Route::get('/', [Usergroups::class, 'index'])->name('user-groups');
        Route::get('/json', [Usergroups::class, 'json'])->name('user-groups');
        Route::get('/edit/{id}', [Usergroups::class, 'edit'])->name('user-groups');
        Route::post('/store', [Usergroups::class, 'store'])->name('user-groups');
        Route::get('/search', [Usergroups::class, 'search'])->name('user-groups');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
        Route::get('/chart-data2', [DashboardController::class, 'chartData2'])->name('dashboard.chart-data2');
        Route::get('/chart-data3', [DashboardController::class, 'chartData3'])->name('dashboard.chart-data3');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/menu-group', [GroupMenu::class, 'index'])->name('menu-group');

    Route::get('/speed-test', [SpeedTestController::class, 'index'])->name('speed-test');
    Route::get('/speed-test-json', [SpeedTestController::class, 'json'])->name('speed-test');
});

Route::middleware(['auth', 'verified'])
    ->prefix('penyuluh')
    ->group(function () {
        Route::get('/', [PenyuluhController::class, 'index'])->name('penyuluh');
        Route::get('/json', [PenyuluhController::class, 'json'])->name('penyuluh');
        Route::post('/store', [PenyuluhController::class, 'store'])->name('penyuluh');
        Route::get('/edit/{id}', [PenyuluhController::class, 'edit'])->name('penyuluh');
        Route::get('/search', [PenyuluhController::class, 'search'])->name('penyuluh');
    });

require __DIR__ . '/auth.php';

Auth::routes();
