<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class AdminKaryawanController extends Controller
{
    public function listPage()
    {
        $karyawans = Karyawan::orderBy('created_at', 'desc')->get();

        return view('pages.admin.karyawan.list', compact('karyawans'));
    }

    public function pendingPage()
    {
        $karyawans = Karyawan::with('user')
                                ->whereHas('user', function ($query) {
                                    $query->whereNull('email_verified_at');
                                })
                                ->orderBy('created_at', 'desc')
                                ->get();
        return view('pages.admin.karyawan.pendingList', compact('karyawans'));
    }

    public function detail($id)
    {
        $id_karyawan = Hashids::decode($id)[0] ?? null;
        $karyawan = Karyawan::findOrFail($id_karyawan);
        return view('pages.admin.karyawan.detail', compact('karyawan'));
    }

    public function edit($id)
    {
        $id_karyawan = Hashids::decode($id)[0] ?? null;
        $karyawan = Karyawan::findOrFail($id_karyawan);
        return view('pages.admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nik' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'jenis_kelamin' => 'required|string',
                'cabang' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $id_karyawan = Hashids::decode($id)[0] ?? null;
            $karyawan = Karyawan::findOrFail($id_karyawan);
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

            return redirect()->route('admin.karyawan.edit', $id)->with('success', 'Data karyawan berhasil diubah.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah data karyawan.');
        }
    }

    public function validate(Request $request)
    {
        // Validasi input
        $request->validate([
            'ids' => 'required|array',
            'need' => 'required|string|in:disetujui,ditolak',
        ]);

        try {
            $hashedIds = $request->input('ids');

            $ids = array_map(function($hashedId) {
                return Hashids::decode($hashedId)[0] ?? null;
            }, $hashedIds);

            // Filter out null values (in case decoding failed)
            $ids = array_filter($ids);

            // Validasi id yang ter-decode
            if (empty($ids)) {
                return response()->json([
                    'status' => [
                        'message' => 'ID karyawan tidak valid.'
                    ]
                ], 422);
            }

            if($request->input('need') == 'disetujui') {
                User::whereIn('id', $ids)->update(['email_verified_at' => now()]);
            } else {
                Karyawan::whereIn('id_user', $ids)->delete();
                User::whereIn('id', $ids)->delete();
            }

            return response()->json([
                'status' => [
                    'message' => 'Data karyawan berhasil '.$request->input('need').'.'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => [
                    'message' => 'Server error, data karyawan gagal '.$request->input('need').'.',
                    'error' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $id_karyawan = Hashids::decode($id)[0] ?? null;
            $karyawan = Karyawan::findOrFail($id_karyawan);
            $karyawan->delete();

            return redirect()->back()->with('success', 'Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus karyawan.');
        }
    }

}
