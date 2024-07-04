<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/karyawan">List Data Karyawan</a></li>
                <li class="breadcrumb-item active">Detail Karyawan</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Detail Karyawan
                </div>
                <div class="card-body text-center">
                    <h2>Data detail karyawan</h2>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-3 mb-4 d-flex justify-content-center align-items-center flex-column">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/profile').'/'.$karyawan->foto }}" class="rounded img-fluid" alt="Foto Karyawan">
                            </div>
                            <div class="w-100">
                                @if ($karyawan->status == "aktif")
                                    <div class="alert alert-success" role="alert">
                                        <b>Aktif</b>
                                    </div>
                                @elseif ($karyawan->status == "cuti")
                                    <div class="alert alert-warning" role="alert">
                                        <b>Cuti</b>
                                    </div>
                                @elseif ($karyawan->status == "sakit")
                                    <div class="alert alert-warning" role="alert">
                                        <b>Sakit</b>
                                    </div>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        <b>Tidak Aktif</b>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-9 mb-4">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">NIK</th>
                                        <td>{{ $karyawan->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama</th>
                                        <td>{{ $karyawan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $karyawan->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jabatan</th>
                                        <td>
                                            @if ($karyawan->jabatan == '')
                                                <span class="text-danger">Jabatan belum dimasukkan</span>
                                            @else
                                                {{ $karyawan->jabatan }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nomer Handphone</th>
                                        <td>{{ $karyawan->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Provinsi</th>
                                        <td>
                                            @if ($karyawan->provinsi == '')
                                                <span class="text-danger">Provinsi belum dimasukkan</span>
                                            @else
                                                {{ $karyawan->provinsi }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Alamat</th>
                                        <td>
                                            @if ($karyawan->alamat == '')
                                                <span class="text-danger">Alamat belum dimasukkan</span>
                                            @else
                                                {{ $karyawan->alamat }}
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
