<?php

namespace App\Http\Controllers\Admin;

use App\Models\Izin;
use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;

class AdminIndexController extends Controller
{
    public function index()
    {
        // total karyawan aktif
        $karyawanAktif = Karyawan::where('status', 'aktif')->count();
        // total karyawan izin sakit
        $karyawanSakit = Izin::where('keterangan', 'sakit')->count();
        // total karyawan izin cuti
        $karyawanCuti = Izin::where('keterangan', 'cuti')->count();

        $count = [
            'karyawan_aktif' => $karyawanAktif,
            'karyawan_sakit' => $karyawanSakit,
            'karyawan_cuti' => $karyawanCuti
        ];

        return view('pages.admin.dashboard.index', compact('count'));
    }

    public function laporanPage(Request $request)
    {
       return view('pages.admin.laporan.index');
    }

    public function laporan(Request $request)
    {
       // Ambil bulan dan tahun dari request
       $month = $request->input('month');
       $year = $request->input('year');

       // Dapatkan semua karyawan
       $employees = Karyawan::all();

       // Buat array untuk menyimpan absensi per hari per karyawan
       $absens = [];

       // Iterate over each employee
       foreach ($employees as $employee) {
           $absens[$employee->id]['nama'] = $employee->nama;

           // Iterate over each day in the month
           for ($day = 1; $day <= Carbon::create($year, $month)->daysInMonth; $day++) {
               // Get the date for the current day
               $date = Carbon::create($year, $month, $day);

               // Find the attendance record for the current employee and date
               $absen = Absen::where('id_karyawan', $employee->id)
                                    ->whereDate('waktu_masuk', $date)
                                    ->first();

               // Store the check-in time or 'N/A' if not found
               $absens[$employee->id]['days'][$day] = $absen ? Carbon::parse($absen->waktu_masuk)->format('H:i') : '-';
           }
       }

       return view('pages.admin.laporan.index', compact('absens', 'month', 'year'));
    }

}
