<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class AdminAbsenController extends Controller
{
    public function listPage()
    {
        $absens = Absen::orderBy('created_at', 'desc')->get();
        return view('pages.admin.absen.list', compact('absens'));
    }

    public function requestPage()
    {
        $absens = Absen::where('status', 'tertunda')->orderBy('created_at', 'desc')->get();
        return view('pages.admin.absen.requestList', compact('absens'));
    }

    public function detail($id)
    {
        $id_absen = Hashids::decode($id)[0] ?? null;
        $absen = Absen::findOrFail($id_absen);
        return view('pages.admin.absen.detail', compact('absen'));
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
                        'message' => 'ID Absen karyawan tidak valid.'
                    ]
                ], 422);
            }

            // Update status Izin karyawan berdasarkan id
            if($request->input('need') == 'disetujui') {
                Absen::whereIn('id', $ids)->update(['status' => 'disetujui']);
            } else {
                Absen::whereIn('id', $ids)->update(['status' => 'ditolak']);
            }

            return response()->json([
                'status' => [
                    'message' => 'Absen karyawan berhasil '.$request->input('need').'.'
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
