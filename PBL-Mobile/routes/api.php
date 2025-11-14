<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckClockSettingTimeController;
use App\Http\Controllers\CheckClockController;

// Rute bawaan Laravel untuk user login via Sanctum (bisa abaikan kalau belum pakai)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes
Route::apiResource('check-clock-settings', CheckClockSettingTimeController::class);
Route::apiResource('check-clocks', CheckClockController::class);
