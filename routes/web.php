<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GroupMenu;
use App\Http\Controllers\Parameter;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Usergroups;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpeedTestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');

    Route::get('/menu-group', [GroupMenu::class, 'index'])->name('menu-group');

    Route::get('/parameter', [Parameter::class, 'index'])->name('parameter');
    Route::get('/parameter-json', [Parameter::class, 'json'])->name('parameter');
    Route::get('/parameter-edit/{id}', [Parameter::class, 'edit'])->name('parameter');
    Route::post('/parameter-store', [Parameter::class, 'store'])->name('parameter');

    Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
    Route::get('/permission-json', [PermissionController::class, 'json'])->name('permission');
    Route::post('/permission-store', [PermissionController::class, 'store'])->name('permission');
    Route::get('/permission-edit/{id}', [PermissionController::class, 'edit'])->name('permission');

    Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    Route::get('/user-management-json', [UserController::class, 'json'])->name('user-management');
    Route::get('/user-management-edit/{id}', [UserController::class, 'edit'])->name('user-management');
    Route::post('/user-management-store', [UserController::class, 'store'])->name('user-management');

    Route::get('/user-groups', [Usergroups::class, 'index'])->name('user-groups');

    Route::get('/speed-test', [SpeedTestController::class, 'index'])->name('speed-test');
    Route::get('/speed-test-json', [SpeedTestController::class, 'json'])->name('speed-test');
});

require __DIR__ . '/auth.php';

Auth::routes();
