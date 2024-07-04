<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login', absolute: false));
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/karyawan.php';
