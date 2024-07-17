<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AbsenController extends Controller
{
    public function listPage()
    {
        $id_karyawan = Auth::user()->karyawan->id;
        $absens = Absen::where('id_karyawan', $id_karyawan)
            ->orderBy('waktu_masuk', 'desc')
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->mulai)->format('F Y'); // Mengelompokkan berdasarkan bulan dan tahun
            });

        return view('pages.karyawan.absen.list', compact('absens'));
    }

    public function createPage()
    {
        $id_user = Auth::id();
        $status_karyawan = Auth::user()->karyawan->status;

        if ($status_karyawan != 'aktif') {
            return redirect()->back()->with('error', "Maaf, kamu saat ini sedang {$status_karyawan}.");
        }

        $id_karyawan = Auth::user()->karyawan->id;

        $tanggal_hari_ini = Carbon::today('Asia/Jakarta')->format('Y-m-d');

        $absen_hari_ini = Absen::where('id_karyawan', $id_karyawan)
                                        ->whereIn('status', ['diterima', 'tertunda'])
                                        ->whereDate('waktu_masuk', $tanggal_hari_ini)
                                        ->exists();

        if ($absen_hari_ini) {
            return redirect()->back()->with('error', 'Anda sudah absen masuk pada hari ini.');
        }

        $nama = Karyawan::where('id_user', $id_user)->firstOrFail()->nama;
        return view('pages.karyawan.absen.create', compact('nama'));
    }

    public function store(Request $request)
    {
        try {
            $id_karyawan = Auth::user()->karyawan->id;

            $request->validate([
                'latitude' => 'required|string|max:20',
                'longitude' => 'required|string|max:20',
                'jarak' => 'required|string|max:20',
                'waktu_masuk' => 'required',
            ]);

            // Mendekode data base64
            $imageData = $request->input('bukti'); // Mengambil input dari field 'bukti'

            // Validasi format data base64
            if (!preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $imageType = strtolower($type[1]); // png, jpg, jpeg, gif

            // Memeriksa jenis gambar yang diizinkan (misalnya hanya png dan jpeg)
            if (!in_array($imageType, ['png', 'jpeg', 'jpg'])) {
                return response()->json(['error' => 'Invalid image type'], 400);
            }

            $imageBase64 = base64_decode($imageData);

            if ($imageBase64 === false) {
                return response()->json(['error' => 'Base64 decode failed'], 400);
            }

            // Mendapatkan nama pengguna
            $userName = Auth::user()->karyawan->nama;
            $userName = Str::slug($userName); // Mengubah nama menjadi slug untuk nama file yang valid

            // Membuat nama file unik dengan format tanggal-waktu-nama
            $dateTime = now()->format('Y-m-d_H-i-s');
            $imageName = "{$dateTime}_{$userName}.{$imageType}";

            // Menentukan path untuk menyimpan file
            $folderPath = public_path('assets/img/absen');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }
            $filePath = $folderPath . '/' . $imageName;

            // Menyimpan file ke folder tujuan
            File::put($filePath, $imageBase64);

            // Ambil waktu kehadiran dari input pengguna dan setel zona waktu ke WIB
            $waktu_masuk = $request->input('waktu_masuk');
            $waktu = Carbon::parse($waktu_masuk)->setTimezone('Asia/Jakarta');

            // Tentukan batas waktu kehadiran pada jam 8 pagi WIB
            $batas_waktu = Carbon::parse($waktu->format('Y-m-d') . ' 08:01:00', 'Asia/Jakarta');

            // Bandingkan waktu kehadiran dengan batas waktu
            if ($waktu->greaterThan($batas_waktu)) {
                $status_kehadiran = 'terlambat';
            } else {
                $status_kehadiran = 'tepat waktu';
            }

            // Gabungkan data request dengan ID karyawan dan path file gambar
            $data = array_merge($request->all(), [
                'id_karyawan' => $id_karyawan,
                'bukti' => $imageName,
                'waktu_masuk' => $waktu,
                'kehadiran' => $status_kehadiran,
            ]);

            // Simpan data absen ke dalam database
            Absen::create($data);

            return redirect()->route('absen')->with('status', 'Absen berhasil disimpan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pulang($id)
    {
        try {
            $id_absen = Hashids::decode($id)[0] ?? null;

            $absen = Absen::findOrFail($id_absen);

            // Periksa apakah ada entri absen dengan waktu_keluar pada hari ini
            $absen_hari_ini = Absen::where('id', $id_absen)
                                    ->whereNotNull('waktu_keluar')
                                    ->exists();

            if ($absen_hari_ini) {
                return redirect()->back()->with('error', 'Anda sudah absen pulang.');
            }

            // Ambil waktu pulang dari input pengguna dan setel zona waktu ke WIB
            $waktu_keluar = now()->setTimezone('Asia/Jakarta');

            // Perbarui data absen dengan waktu pulang
            $absen->update([
                'waktu_keluar' => $waktu_keluar,
            ]);

            return redirect()->route('absen')->with('status', 'Absen pulang berhasil disimpan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
