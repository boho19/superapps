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
    @include('pages.karyawan.profile.partials.update-profile-form')
    {{-- @include('pages.karyawan.profile.partials.update-password-form') --}}
</x-karyawan-layout>
