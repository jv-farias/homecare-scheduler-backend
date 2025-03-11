<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::group(['prefix' => 'attendances'], function () {
    Route::get('/', [AttendanceController::class, 'index']);
    Route::get('/metrics', [AttendanceController::class, 'metrics']);
    Route::post('/', [AttendanceController::class, 'store']);
    Route::get('/{id}', [AttendanceController::class, 'show']);
    Route::put('/{id}', [AttendanceController::class, 'update']);
    Route::delete('/{id}', [AttendanceController::class, 'destroy']);
});
