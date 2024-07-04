<x-karyawan-layout>
    <div class="row">
        <div class="col-auto align-self-center">
            <a href="{{ route('izin') }}" class="btn btn-link back-btn text-color-theme">
                <i class="bi bi-arrow-left size-20"></i>
            </a>
        </div>
        <div class="col text-center align-self-center">
            <h3 class="mb-0">Edit Profile</h3>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-auto">
            <figure class="avatar avatar-100 rounded mx-auto my-1">
                <img src="{{ asset('assets/img/profile').'/'. $data->foto }}" alt="">
            </figure>
        </div>
        <div class="col align-self-center ps-0">
            <h5 class="">{{ $data->nama }}</h5>
            <p class="text-opac">{{ $data->user->email }}</p>
            <p class="text-opac">{{ $data->alamat }}</p>
        </div>
    </div>
    <form method="POST" action="/profile/update">
        <!-- add edit address form -->
        <div class="row mb-3">
            <div class="col">
                <h5 class="mb-0">Detail Profile</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-light shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            {{-- NIK --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="nik" class="form-control" value="{{ $data->nik }}" id="nik"
                                        placeholder="NIK">
                                    <label class="form-control-label" for="nik">NIK</label>
                                </div>
                            </div>
                            {{-- Nama  --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" id="nama"
                                        placeholder="Nama Lengkap">
                                    <label class="form-control-label" for="address1">Nama Lengkap</label>
                                </div>
                            </div>
                            {{-- Nomer Handphone --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="number" name="no_hp" class="form-control" value="{{ $data->no_hp }}" id="no_hp"
                                        placeholder="Nomer Handphone">
                                    <label class="form-control-label" for="no_hp">Nomer Handphone</label>
                                </div>
                            </div>
                            {{-- Jenis Kelamin --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <select class="form-control" id="jk" name="jk" required>
                                        <option disabled {{ !empty($data->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                        <option value="LK" {{ $data->jenis_kelamin == 'LK' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="PR" {{ $data->jenis_kelamin == 'PR' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <label class="form-control-label" for="jk">Jenis Kelamin</label>
                                </div>
                            </div>
                            {{-- Alamat --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}" id="alamat"
                                        placeholder="Alamat">
                                    <label class="form-control-label" for="alamat">Alamat</label>
                                </div>
                            </div>
                            {{-- Provinsi --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="provinsi" class="form-control" value="{{ $data->provinsi }}" id="provinsi"
                                        placeholder="Provinsi">
                                    <label class="form-control-label" for="provinsi">Provinsi</label>
                                </div>
                            </div>
                            {{-- Jabatan --}}
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="jabatan" class="form-control" value="{{ $data->jabatan }}" id="jabatan"
                                        placeholder="Jabatan">
                                    <label class="form-control-label" for="jabatan">Jabatan</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group form-floating ">
                                    <input type="file" name="foto" class="form-control" id="foto">
                                    <label for="foto">Foto Profile</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- change password -->
        <div class="row mb-3">
            <div class="col">
                <h5 class="mb-0">Ganti Password</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-light shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row h-100">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating  mb-3">
                                    <input type="password" class="form-control" value="asdasdasdsd" placeholder="Password"
                                        id="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-floating ">
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword">
                                    <label for="confirmpassword">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-center">
            <x-primary-button>Update</x-primary-button>
        </div>
    </form>
</x-karyawan-layout>
