<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['throttle:60,1'])->get('/ping', function () {
    return response()->json(['message' => 'Pong!']);
});
Route::get('/users', [UserController::class, 'index']);
