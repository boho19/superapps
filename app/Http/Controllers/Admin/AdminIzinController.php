<?php

namespace App\Http\Controllers\Admin;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class AdminIzinController extends Controller
{
    public function listPage()
    {
        $izins = Izin::orderBy('created_at', 'desc')->get();
        return view('pages.admin.izin.list', compact('izins'));
    }

    public function requestPage()
    {
        $izins = Izin::where('status', 'tertunda')->orderBy('created_at', 'desc')->get();
        return view('pages.admin.izin.requestList', compact('izins'));
    }

    public function detail($id)
    {
        $id_izin = Hashids::decode($id)[0] ?? null;
        $izin = Izin::findOrFail($id_izin);
        return view('pages.admin.izin.detail', compact('izin'));
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
                        'message' => 'ID Izin karyawan tidak valid.'
                    ]
                ], 422);
            }

            // Update status Izin karyawan berdasarkan id
            if($request->input('need') == 'disetujui') {
                DB::transaction(function () use ($ids) {
                    // Update status di tabel izin
                    Izin::whereIn('id', $ids)->update(['status' => 'disetujui']);

                    // Ambil semua data izin yang telah diperbarui
                    $izins = Izin::whereIn('id', $ids)->get();

                    // Iterasi melalui setiap izin untuk mengupdate tabel karyawan
                    foreach ($izins as $izin) {
                        Karyawan::where('id', $izin->id_karyawan)->update(['status' => $izin->keterangan]);
                    }
                });
            } else {
                Izin::whereIn('id', $ids)->update(['status' => 'ditolak']);
            }

            return response()->json([
                'status' => [
                    'message' => 'Izin karyawan berhasil .'.$request->input('need').'.'
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

}
