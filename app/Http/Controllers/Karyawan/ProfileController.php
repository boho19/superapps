<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Absen;
use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;

class ProfileController
{
    public function profile()
    {
        $id = Auth::id();
        $data = Karyawan::where('id_user', $id)->first();
        $jumlahAbsen = Absen::where('id_karyawan', $data->id)->count();
        $jumlahIzin = Izin::where('id_karyawan', $data->id)->count();
        return view('pages.karyawan.profile.index', compact('data', 'jumlahAbsen', 'jumlahIzin'));
    }

    public function edit()
    {
        $id = Auth::id();
        $data = Karyawan::where('id_user', $id)->first();
        return view('pages.karyawan.profile.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nik' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'jenis_kelamin' => 'required|string|in:LK,PR',
                'cabang' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $id = Auth::id();
            $karyawan = Karyawan::where('id_user', $id)->first();
    
            // Handle image upload
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('/profile', $imageName, 'public_custom');
            } else {
                $imageName = $karyawan->foto;
            }
    
            $data = array_merge($request->all(),[
                'foto' => $imageName
            ]);
            $karyawan->update($data);
    
            return Redirect::route('profile')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ganti (){
        return redirect()->back()->with('error', 'Anda sudah absen pulang.');
    }
}
