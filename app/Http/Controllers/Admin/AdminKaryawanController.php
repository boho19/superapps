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
