<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LopHocController;
use App\Http\Controllers\Api\SinhVienController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::apiResource('lop-hoc', LopHocController::class)->parameters(['lop-hoc' => 'lopHoc']);
    Route::apiResource('sinh-vien', SinhVienController::class)->parameters(['sinh-vien' => 'sinhvien']);
});
