<?php

use App\Http\Middleware\isValidAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminIzinController;
use App\Http\Controllers\Admin\AdminAbsenController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminKaryawanController;

Route::prefix('admin')->middleware(['auth', 'verified', isValidAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminIndexController::class, 'index'])->name('admin.dashboard');

    Route::get('/laporan', [AdminIndexController::class, 'laporanPage'])->name('admin.laporan');
    Route::post('/laporan', [AdminIndexController::class, 'laporan'])->name('admin.laporan');

    Route::get('/karyawan', [AdminKaryawanController::class, 'listPage'])->name('admin.karyawan');
    Route::get('/karyawan/pending', [AdminKaryawanController::class, 'pendingPage'])->name('admin.karyawan.pending');
    Route::get('/karyawan/detail/{id}', [AdminKaryawanController::class, 'detail'])->name('admin.karyawan.detail');
    Route::get('/karyawan/edit/{id}', [AdminKaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::patch('/karyawan/update/{id}', [AdminKaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::patch('/karyawan/validate', [AdminKaryawanController::class, 'validate'])->name('admin.karyawan.validate');
    Route::get('/karyawan/delete/{id}', [AdminKaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');

    Route::get('/absen', [AdminAbsenController::class, 'listPage'])->name('admin.absen');
    Route::get('/absen/request', [AdminAbsenController::class, 'requestPage'])->name('admin.absen.request');
    Route::get('/absen/detail/{id}', [AdminAbsenController::class, 'detail'])->name('admin.absen.detail');
    Route::patch('/absen/validate', [AdminAbsenController::class, 'validate'])->name('admin.absen.validate');

    Route::get('/izin', [AdminIzinController::class, 'listPage'])->name('admin.izin');
    Route::get('/izin/request', [AdminIzinController::class, 'requestPage'])->name('admin.izin.request');
    Route::get('/izin/detail/{id}', [AdminIzinController::class, 'detail'])->name('admin.izin.detail');
    Route::patch('/izin/validate', [AdminIzinController::class, 'validate'])->name('admin.izin.validate');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');

});
