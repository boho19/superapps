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
                        <div class="col-12 col-md-3 mb-4 d-flex justify-content-center align-items-center flex-column">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/profile').'/'.$izin->karyawan->foto }}" class="rounded img-fluid" alt="Foto Karyawan">
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-9 mb-4">
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
                                        <td>{{ $izin->keterangan }}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>
