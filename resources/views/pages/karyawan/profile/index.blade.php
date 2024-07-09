<x-karyawan-layout>
    <div class="row">
        <div class="col-12">
            <div class="card card-theme shadow-sm mb-4">
                <div class="card-body">
                    <div class="card card-light mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-80 rounded mx-auto">
                                        <img src="{{ asset('assets/img/profile').'/'. $data->foto }}" alt="">
                                    </figure>
                                </div>
                                <div class="col align-self-center">
                                    <h5 class="mb-0">{{ ucwords($data->nama) }}</h5>
                                    <p class="text-opac">{{ $data->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-sm product">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 rounded bg-danger text-white">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </div>
                                        </div>
                                        <div class="col ps-0 align-self-center">
                                            <span class="small text-opac mb-0">Total Absen</span>
                                            <p class="mb-1">{{ $jumlahAbsen }} Kali</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm product">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 rounded bg-success text-white">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </div>
                                        </div>
                                        <div class="col ps-0 align-self-center">
                                            <span class="small text-opac mb-0">Total Izin</span>
                                            <p class="mb-1">{{ $jumlahIzin }} Kali</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-4">
        <div class="col d-grid">
            <div class="card card-light shadow-sm">
                @if ($data->status == 'aktif')
                    <div class="card-body text-center bg-success rounded">
                        <h5>Aktif</h5>
                    </div>
                @elseif ($data->status == 'cuti')
                    <div class="card-body text-center bg-primary rounded">
                        <h5>Cuti</h5>
                    </div>
                @elseif ($data->status == 'sakit')
                    <div class="card-body text-center bg-warning rounded">
                        <h5>Sakit</h5>
                    </div>
                @else
                    <div class="card-body text-center bg-danger rounded">
                        <h5>Tidak Aktif</h5>
                    </div>
                @endif
                
            </div>
        </div>
    </div> --}}

    <!-- experince -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Detail Profile</h5>
        </div>
        <div class="col-auto pe-0">
            <a class="link text-color-theme" href="{{ url('profile/edit') }}">Edit Profile <i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <ul class="list-group list-group-flush my-2 bg-none">
                    {{-- NIK --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p>{{ $data->nik }}<br><small class="text-opac">NIK</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Cabang --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p>
                                    @if ($data->cabang == '')
                                        <span class="text-danger">Cabang Belum di Masukan</span>
                                    @else
                                        {{ $data->cabang }}
                                    @endif
                                    <br>
                                <small class="text-opac">Cabang</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Jenis Kelamin --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p>
                                @if ($data->jenis_kelamin === 'LK')
                                    Laki - Laki
                                @else
                                    Perempuan
                                @endif
                                <br>
                                <small class="text-opac">Jenis Kelamin</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Nomer Handphone --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p>{{ $data->no_hp }}<br>
                                <small class="text-opac">Nomer Handphone</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Alamat --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p>
                                    @if ($data->alamat == '')
                                        <span class="text-danger">Alamat Belum di Masukan</span>
                                    @else
                                        {{ $data->alamat }}
                                    @endif
                                    <br>
                                <small class="text-opac">Alamat</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Provinsi --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                            <p>
                                @if ($data->provinsi == '')
                                    <span class="text-danger">Provinsi Belum di Pilih</span>
                                @else
                                    {{ $data->provinsi }}
                                @endif
                                <br>
                                <small class="text-opac">Provinsi</small></p>
                            </div>
                        </div>
                    </li>
                    {{-- Jabatan --}}
                    <li class="list-group-item border-0">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-circle">
                                    <img src="{{ asset('assets/img/bgshapes.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col px-0">
                            <p>
                                @if ($data->jabatan == '')
                                    <span class="text-danger">Jabatan Belum dimasukan</span>
                                @else
                                    {{ $data->jabatan }}
                                @endif
                                <br>
                                <small class="text-opac">Jabatan</small></p>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</x-karyawan-layout>
