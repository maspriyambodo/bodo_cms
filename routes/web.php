<?php

use App\Http\Controllers\Auth\LoginController;
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
use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('rate.limit')->get('/', [LoginController::class, 'showLoginForm'])->name('Login');
Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
Route::middleware(['auth', 'verified'])
    ->prefix('menu')
    ->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu');
        Route::get('/json', [MenuController::class, 'json'])->name('menu.json');
        Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('menugrup')
    ->group(function () {
        Route::get('/json', [GroupMenu::class, 'json'])->name('menugrup.json');
        Route::post('/store', [GroupMenu::class, 'store'])->name('menugrup.store');
        Route::get('/edit/{id}', [GroupMenu::class, 'edit'])->name('menugrup.edit');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('parameter')
    ->group(function () {
        Route::get('/', [Parameter::class, 'index'])->name('parameter');
        Route::get('/json', [Parameter::class, 'json'])->name('parameter.json');
        Route::get('/edit/{id}', [Parameter::class, 'edit'])->name('parameter.edit');
        Route::post('/store', [Parameter::class, 'store'])->name('parameter.store');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('provinsi')
    ->group(function () {
        Route::get('/', [Provinsi::class, 'index'])->name('provinsi');
        Route::get('/json', [Provinsi::class, 'json'])->name('provinsi.json');
        Route::post('/store', [Provinsi::class, 'store'])->name('provinsi.store');
        Route::get('/edit/{id}', [Provinsi::class, 'edit'])->name('provinsi.edit');
        Route::post('/get-kabupaten', [Provinsi::class, 'get_kabupaten'])->name('provinsi.get_kabupaten');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kabupaten')
    ->group(function () {
        Route::get('/', [KabupatenController::class, 'index'])->name('kabupaten');
        Route::get('/json', [KabupatenController::class, 'json'])->name('kabupaten.json');
        Route::post('/store', [KabupatenController::class, 'store'])->name('kabupaten.store');
        Route::get('/edit/{id}', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
        Route::get('/search', [KabupatenController::class, 'search'])->name('kabupaten.search');
        Route::post('/get-kecamatan', [KabupatenController::class, 'get_kecamatan'])->name('kabupaten.get_kecamatan');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kecamatan')
    ->group(function () {
        Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan');
        Route::get('/json', [KecamatanController::class, 'json'])->name('kecamatan.json');
        Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
        Route::get('/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
        Route::get('/search', [KecamatanController::class, 'search'])->name('kecamatan.search');
        Route::post('/get-kelurahan', [KecamatanController::class, 'get_kelurahan'])->name('kecamatan.get_kelurahan');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('kelurahan')
    ->group(function () {
        Route::get('/', [KelurahanController::class, 'index'])->name('kelurahan');
        Route::get('/json', [KelurahanController::class, 'json'])->name('kelurahan.json');
        Route::post('/store', [KelurahanController::class, 'store'])->name('kelurahan.store');
        Route::get('/edit/{id}', [KelurahanController::class, 'edit'])->name('kelurahan.edit');
        Route::get('/search', [KelurahanController::class, 'search'])->name('kelurahan.search');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('permission')
    ->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission');
        Route::get('/json', [PermissionController::class, 'json'])->name('permission.json');
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::get('/set-json', [PermissionController::class, 'json2'])->name('permission.set_json');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('user-management')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('umgmt');
        Route::get('/json', [UserController::class, 'json'])->name('umgmt.json');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('umgmt.edit');
        Route::post('/store', [UserController::class, 'store'])->name('umgmt.store');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('nama-bank')
    ->group(function () {
        Route::get('/', [BankController::class, 'index'])->name('nama-bank');
        Route::get('/json', [BankController::class, 'json'])->name('nama-bank.json');
        Route::post('/store', [BankController::class, 'store'])->name('nama-bank.store');
        Route::get('/edit/{id}', [BankController::class, 'edit'])->name('nama-bank.edit');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/menu-group', [GroupMenu::class, 'index'])->name('menu-group');

    Route::get('/speed-test', [SpeedTestController::class, 'index'])->name('speed-test');
    Route::get('/speed-test-json', [SpeedTestController::class, 'json'])->name('speed-test.json');
});

require __DIR__ . '/auth.php';

Auth::routes();
