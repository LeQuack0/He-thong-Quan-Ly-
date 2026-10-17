<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\UserController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tai-khoan-cua-toi', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('/tai-khoan-cua-toi', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::middleware('role:admin,giang_vien')->group(function () {
        Route::resource('lophoc', LopHocController::class);
        Route::resource('sinhvien', SinhVienController::class);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('menu', MenuController::class)->except('show');
        Route::resource('users', UserController::class)->except(['show']);
    });
});
