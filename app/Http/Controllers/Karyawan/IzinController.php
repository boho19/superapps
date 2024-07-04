<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class IzinController extends Controller
{
    public function listPage()
    {
        $id_karyawan = Auth::user()->karyawan->id;
        $izins = Izin::where('id_karyawan', $id_karyawan)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->mulai)->format('F Y'); // Mengelompokkan berdasarkan bulan dan tahun
            });
        return view('pages.karyawan.izin.list', compact('izins'));
    }

    public function createPage()
    {
        return view('pages.karyawan.izin.create');
    }

    public function storeData(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'required',
            'alasan' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
        ]);
        try {
            // Ambil ID karyawan dari user yang sedang login
            $id_user = Auth::id();
            $karyawan = Karyawan::where('id_user', $id_user)->firstOrFail();
            $id_karyawan = $karyawan->id;

            // Gabungkan data request dengan ID karyawan
            $data = array_merge($request->all(), ['id_karyawan' => $id_karyawan]);

            Izin::create($data);

            return redirect()->route('izin')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error', 'Server error, gagal menambahkan data.')
            ->withInput();
        }


    }

}
