<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Izin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/izin">List Perizinan</a></li>
                <li class="breadcrumb-item active">Detail Izin</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Detail Izin Karyawan
                </div>
                <div class="card-body text-center">
                    <h2>Data detail Izin</h2>
                    <hr>
                    <div class="row">
                    @if ($izin->bukti)
                        <div class="col-12 col-md-3 mb-4 d-flex justify-content-center align-items-center flex-column">
                            <div class="text-center mb-3">
                                {{-- <img src="{{ asset('assets/img/profile').'/'.$izin->karyawan->foto }}" class="rounded img-fluid" alt="Foto Karyawan"> --}}
                                <img src="{{ asset('assets/img/perizinan').'/'.$izin->bukti }}" class="rounded img-fluid" alt="Bukti Perizinan">
                                <hr>
                                <h5>Lampiran</h5>
                            </div>
                        </div>
                        <div class="col-9 col-md-9 mb-4">
                    @else
                        <div class="col-12 col-md-12 mb-4">
                    @endif
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Nama</th>
                                        <td>{{ $izin->karyawan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            @if ($izin->status == 'disetujui')
                                            <span class="badge bg-success">{{ ucwords($izin->status) }}</span>
                                            @elseif($izin->status == 'tertunda')
                                            <span class="badge bg-warning">{{ ucwords($izin->status) }}</span>
                                            @else
                                            <span class="badge bg-danger">{{ ucwords($izin->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Keterangan</th>
                                        <td>
                                            @if ($izin->keterangan == 'sakit')
                                                <span class="badge bg-warning">{{ $izin->keterangan }}</span>
                                            @else
                                                <span class="badge bg-primary">{{ $izin->keterangan }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Alasan</th>
                                        <td>{{ $izin->alasan }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mulai</th>
                                        <td>{{ $izin->mulai }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Selesai</th>
                                        <td>{{ $izin->selesai }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Bukti</th>
                                        <td>
                                            <img src="{{ asset('assets/img/perizinan').'/'.$izin->bukti }}" class="rounded img-fluid pt-2" alt="Bukti Perizinan">
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>
