<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function profile()
    {
        $id = Auth::id();
        $data = Karyawan::where('id_user', $id)->first();
        return view('pages.karyawan.profile.index', compact('data'));
    }

    public function edit()
    {
        $id = Auth::id();
        $data = Karyawan::findOrFail($id);
        return view('pages.karyawan.profile.edit', compact('data'));
    }
}
