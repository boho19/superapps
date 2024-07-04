<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Absen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/absen">List History Absen</a></li>
                <li class="breadcrumb-item active">Detail Absen</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Detail Absen Karyawan
                </div>
                <div class="card-body text-center">
                    <h2>Data Absensi karyawan</h2>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-3 mb-4 d-flex justify-content-center align-items-center flex-column">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/absen').'/'.$absen->bukti }}" class="rounded img-fluid" alt="Foto Karyawan">
                            </div>
                            <div class="w-100">
                                @if ($absen->kehadiran == "tepat waktu")
                                    <div class="alert alert-success" role="alert">
                                        <b>Tepat Waktu</b>
                                    </div>
                                @elseif ($absen->kehadiran == "terlambat")
                                    <div class="alert alert-warning" role="alert">
                                        <b>Terlambat</b>
                                    </div>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        <b>Alfa</b>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-9 mb-4">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Nama</th>
                                        <td>{{ $absen->karyawan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Latitude</th>
                                        <td>{{ $absen->latitude }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Longitude</th>
                                        <td>{{ $absen->longitude }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jarak</th>
                                        <td>{{ number_format($absen->jarak, 1) }} meter</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            @if ($absen->status == 'ditolak')
                                                <span class="badge bg-danger">Absensi Ditolak</span>
                                            @elseif($absen->status == 'tertunda')
                                                <span class="badge bg-warning">Absensi belum Validasi</span>
                                            @else
                                                <span class="badge bg-success">Absensi Diterima</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Waktu Masuk</th>
                                        <td>{{ $absen->waktu_masuk }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Waktu Keluar</th>
                                        <td>
                                            @if (!$absen->waktu_keluar)
                                                <span class="badge bg-danger">Belum absen pulang</span>
                                            @else
                                                {{ $absen->waktu_keluar }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>
