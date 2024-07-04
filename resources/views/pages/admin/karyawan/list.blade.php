<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">List Semua Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">List Karyawan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Karyawan
                </div>
                <div class="card-body text-center">
                    <table id="datatablesSimple" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawans as $index => $karyawan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $karyawan->nik }}</td>
                                <td><a href="/admin/karyawan/detail/{{ $karyawan->hashid }}">{{ $karyawan->nama }}</a></td>
                                <td>
                                    @if ($karyawan->jenis_kelamin == 'LK')
                                    <span class="badge bg-primary">{{ $karyawan->jenis_kelamin }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ $karyawan->jenis_kelamin }}</span>
                                    @endif
                                </td>
                                <td>{{ $karyawan->no_hp }}</td>
                                <td>{{ $karyawan->jabatan }}</td>
                                <td>
                                    @if ($karyawan->status == 'aktif')
                                    <span class="badge bg-success">{{ ucwords($karyawan->status) }}</span>
                                    @elseif($karyawan->status == 'cuti')
                                    <span class="badge bg-warning">{{ ucwords($karyawan->status) }}</span>
                                    @elseif($karyawan->status == 'sakit')
                                    <span class="badge bg-warning">{{ ucwords($karyawan->status) }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ ucwords($karyawan->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/karyawan/edit/{{ $karyawan->hashid }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="/admin/karyawan/delete/{{ $karyawan->hashid }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data {{ $karyawan->nama }}?');" class="btn btn-sm btn-danger">Delete</a>
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
