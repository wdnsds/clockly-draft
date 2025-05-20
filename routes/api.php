<?php

use App\Http\Controllers\Api\GeofenceController;
use App\Http\Controllers\Api\ViolationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);

    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::post('/attendance', [AttendanceController::class, 'store']);

    Route::get('/geofences', [GeofenceController::class, 'index']);
    Route::post('/geofences', [GeofenceController::class, 'store']);

    Route::get('/violations', [ViolationController::class, 'index']);
});
