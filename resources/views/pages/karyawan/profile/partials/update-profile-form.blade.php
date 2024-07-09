<form method="post" action="/profile/update" enctype="multipart/form-data">
    @csrf
    @method('patch')
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
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option disabled {{ !empty($data->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                    <option value="LK" {{ $data->jenis_kelamin == 'LK' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="PR" {{ $data->jenis_kelamin == 'PR' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <label class="form-control-label" for="jenis_kelamin">Jenis Kelamin</label>
                            </div>
                        </div>
                        {{-- Cabang --}}
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="form-group form-floating">
                                <select class="form-control" id="cabang" name="cabang" required>
                                    <option disabled {{ !empty($data->cabang) ? '' : 'selected' }}>Pilih Cabang</option>
                                    <option value="jambi alam barajo" {{ $data->cabang == 'jambi alam barajo' ? 'selected' : '' }}>jambi alam barajo</option>
                                    <option value="jambi jelutung" {{ $data->cabang == 'jambi jelutung' ? 'selected' : '' }}>jambi jelutung</option>
                                    <option value="jambi sortation" {{ $data->cabang == 'jambi sortation' ? 'selected' : '' }}>Jambi Sortation</option>
                                </select>
                                <label class="form-control-label" for="cabang">Pilih Cabang</label>
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

    <div class="col-12 text-center">
        <button class="btn btn-success" type="submit">Update</button>
        {{-- <x-primary-button>Update</x-primary-button> --}}
    </div>
</form>