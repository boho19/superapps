<x-karyawan-layout>
    <h3 class="mb-1 text-center mt-3">ShipTime</h3>
    <div class="mt-5 pt-2 col-12 col-md-6 mx-auto text-center">
        <a href="/absen/create">
            <img  width="80%" src="{{ asset('assets/img/motor.png') }}" alt="">
        </a>
    </div>
    @if (Auth::user()->karyawan->status == 'sakit')
        <div class="text-center mt-5" role="alert">
            Selamat datang kembali, apakah kamu sudah sehat? <a href="/karyawan/set-aktif" class="btn btn-sm btn-info">Sudah Dong 😁</a>
        </div>
    @elseif (Auth::user()->karyawan->status == 'cuti')
        <div class="text-center mt-5" role="alert">
            Selamat datang kembali, apakah kamu sudah aktif kembali? <a href="/karyawan/set-aktif" class="btn btn-sm btn-info">Sudah Dong 😁</a>
        </div>
    @else
        <h3 class="text-center mt-5">Gas Slur....🏁🚴‍♀️🚴‍♀️🚴‍♀️🚴‍♀️🗿</h3>
    @endif
</x-karyawan-layout>
