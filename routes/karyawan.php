<?php

use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isValidKaryawan;
use App\Http\Controllers\Karyawan\IndexController;
use App\Http\Controllers\Karyawan\AbsenController;
use App\Http\Controllers\Karyawan\IzinController;
use App\Http\Controllers\Karyawan\ProfileController;

Route::middleware(['auth', 'verified', isValidKaryawan::class])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

    Route::get('/absen', [AbsenController::class, 'listPage'])->name('absen');
    Route::get('/absen/create', [AbsenController::class, 'createPage'])->name('absen.create');
    Route::post('/absen/store', [AbsenController::class, 'store'])->name('absen.store');
    Route::get('/absen/pulang/{id}', [AbsenController::class, 'pulang'])->name('absen.pulang');

    Route::get('/izin', [IzinController::class, 'listPage'])->name('izin');
    Route::get('/izin/create', [IzinController::class, 'createPage'])->name('izin.create');
    Route::post('/izin/store', [IzinController::class, 'storeData'])->name('izin.store');

    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.password.update');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/password/update', [PasswordController::class, 'update'])->name('password.update');

});
