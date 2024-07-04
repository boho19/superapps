<?php

namespace App\Http\Controllers\Admin;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminIndexController extends Controller
{
    public function index()
    {
        // total karyawan aktif
        $countKaryawanAktif = Karyawan::where('status', 'aktif')->count();
        // total karyawan izin sakit
        $countKaryawanIzinSakit = Izin::where('keterangan', 'sakit')->count();
        // total karyawan izin cuti
        $countKaryawanIzinCuti = Izin::where('keterangan', 'cuti')->count();

        return view('pages.admin.dashboard.index', compact('countKaryawanAktif', 'countKaryawanIzinSakit', 'countKaryawanIzinCuti'));
    }
}
