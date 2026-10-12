<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/brands', [VehicleController::class, 'brands']);
