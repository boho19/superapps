<x-auth-layout>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto align-self-center">
        <h2 class="text-center mb-4">ISI BIODATA</h2>
        <div class="card card-light shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('register.bio.store') }}" class="was-validated" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="id_user" value="{{ old('id_user', session('id')) }}" class="d-none">
                    <div class="form-floating mb-3">
                        <x-text-input type="text" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" :value="old('nik')" maxlength="16" pattern="[0-9]*"  required />
                        <x-input-label for="nik" :value="__('NIK')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="text" id="nama" name="nama" placeholder="Nama Lengkap" :value="old('nama')" required />
                        <x-input-label for="nama" :value="__('Nama Lengkap')" />
                    </div>
                    <div class="form-floating mb-3">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option disabled {{ old('jenis_kelamin')?'':'selected' }}>Pilih Jenis Kelamin</option>
                            <option value="LK" {{ old('jenis_kelamin') == 'LK'?'selected':'' }}>Laki-Laki</option>
                            <option value="PR" {{ old('jenis_kelamin') == 'PR'?'selected':'' }}>Perempuan</option>
                        </select>
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="text" id="no_hp" name="no_hp" placeholder="Nomor Telepon" :value="old('no_hp')" maxlength="15" pattern="[0-9]*" required />
                        <x-input-label for="no_hp" :value="__('Nomor Telepon')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="file" id="foto" name="foto" placeholder="Foto Profile" :value="old('foto')" class="form-control-sm"/>
                        <x-input-label for="no_hp" :value="__('Foto Profile')" />
                    </div>
                    <div class="d-grid">
                        <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
