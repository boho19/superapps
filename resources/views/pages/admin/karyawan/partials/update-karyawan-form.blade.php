<form method="post" action="{{ route('admin.karyawan.update', $karyawan->hashid) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

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
                        <th scope="row">Email</th>
                        <td>
                            <input type="email" name="email" class="form-control" value="{{ $karyawan->user->email }}" id="email"
                                    placeholder="Email">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">NIK</th>
                        <td>
                            <input type="text" name="nik" class="form-control" value="{{ $karyawan->nik }}" id="nik" placeholder="NIK">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>
                            <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" id="nama" placeholder="Nama Lengkap">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis Kelamin</th>
                        <td>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                <option disabled>Pilih Jenis Kelamin</option>
                                <option value="LK" {{ $karyawan->jenis_kelamin == 'LK'?'Selected':'' }}>Laki-laki</option>
                                <option value="PR" {{ $karyawan->jenis_kelamin == 'PR'?'Selected':'' }}>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Nomer Handphone</th>
                        <td>
                            <input type="number" name="no_hp" class="form-control" value="{{ $karyawan->no_hp }}" id="no_hp"
                                    placeholder="No Handphone">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Provinsi</th>
                        <td>
                            <input type="text" name="provinsi" class="form-control" value="{{ $karyawan->provinsi }}" id="provinsi"
                                    placeholder="Provinsi">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Alamat</th>
                        <td>
                            <input type="text" name="alamat" class="form-control" value="{{ $karyawan->alamat }}" id="alamat"
                                    placeholder="Alamat">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Jabatan</th>
                        <td>
                            <input type="text" name="jabatan" class="form-control" value="{{ $karyawan->jabatan }}" id="jabatan"
                                    placeholder="Jabatan">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Cabang</th>
                        <td>
                            <select name="cabang" class="form-control" id="cabang">
                                <option {{ !$karyawan->cabang?'Selected':'' }} disabled>Pilih Cabang</option>
                                <option value="jambi alam barajo" {{ $karyawan->cabang == 'jambi alam barajo'?'Selected':'' }}>Jambi Alam Barajo</option>
                                <option value="jambi jelutung" {{ $karyawan->cabang == 'jambi jelutung'?'Selected':'' }}>Jambi Jelutung</option>
                                <option value="jambi sortation" {{ $karyawan->cabang == 'jambi sortation'?'Selected':'' }}>Jambi Sortation</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Foto Profile</th>
                        <td>
                            <input type="file" name="foto" class="form-control" id="foto">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 text-center">
        <button class="btn btn-success" type="submit">Update</button>
        <button class="btn btn-warning" type="button" onclick="window.location.href='/admin/karyawan'">Kembali</button>
    </div>
</form>
