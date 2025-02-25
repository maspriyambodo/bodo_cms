<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GroupMenu;
use App\Http\Controllers\Parameter;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Usergroups;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpeedTestController;
use App\Http\Controllers\Provinsi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/menu-group', [GroupMenu::class, 'index'])->name('menu-group');

    Route::get('/user-groups', [Usergroups::class, 'index'])->name('user-groups');

    Route::get('/speed-test', [SpeedTestController::class, 'index'])->name('speed-test');
    Route::get('/speed-test-json', [SpeedTestController::class, 'json'])->name('speed-test');
});

require __DIR__ . '/auth.php';

Auth::routes();
