<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">List Semua Perizinan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">List Perizinan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Perizinan
                </div>
                <div class="card-body text-center">
                    <table id="datatablesSimple" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Alasan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($izins as $index => $izin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $izin->karyawan->nama }}</td>
                                <td>
                                    @if ($izin->keterangan == 'sakit')
                                        <span class="badge bg-warning">{{ $izin->keterangan }}</span>
                                    @else
                                        <span class="badge bg-primary">{{ $izin->keterangan }}</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($izin->alasan, 30) }}</td>
                                <td>{{ $izin->mulai }}</td>
                                <td>{{ $izin->selesai }}</td>
                                <td>
                                    @if ($izin->bukti == null)
                                        <span class="badge bg-secondary">--</span>
                                    @else
                                        <img src="{{ asset('assets/img/perizinan').'/'.$izin->bukti }}" alt="foto" width="30px">
                                    @endif
                                </td>
                                <td>
                                    @if ($izin->status == 'disetujui')
                                    <span class="badge bg-success">{{ ucwords($izin->status) }}</span>
                                    @elseif($izin->status == 'tertunda')
                                    <span class="badge bg-warning">{{ ucwords($izin->status) }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ ucwords($izin->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/izin/detail/{{ $izin->hashid }}" class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>
