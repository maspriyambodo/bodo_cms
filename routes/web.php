<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GroupMenu;
use App\Http\Controllers\Parameter;
use App\Http\Controllers\Permission;
use App\Http\Controllers\Usergroups;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');

    Route::get('/menu-group', [GroupMenu::class, 'index'])->name('menu-group');

    Route::get('/parameter', [Parameter::class, 'index'])->name('parameter-system');

    Route::get('/permission', [Permission::class, 'index'])->name('permission-system');

    Route::get('/user-management', [UserController::class, 'index'])->name('user-management');
    Route::get('/user-management-json', [UserController::class, 'json'])->name('user-json');
    Route::get('/user-management-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::post('/user-management-store', [UserController::class, 'store'])->name('user-store');

    Route::get('/user-groups', [Usergroups::class, 'index'])->name('user-groups');
});

require __DIR__ . '/auth.php';

Auth::routes();
