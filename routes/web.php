<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usergroups;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile');
    
    Route::get('/user-groups', [Usergroups::class, 'index'])->name('user-groups');
    
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
});

require __DIR__ . '/auth.php';
