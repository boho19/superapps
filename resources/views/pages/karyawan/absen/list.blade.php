<x-karyawan-layout>
    <h3 class="mb-2 text-center">List History Absensi</h3>
    <a href="/absen/create" class="btn btn-login btn-lg btn-success shadow-sm mb-5">Absen Masuk</a>
    <!-- main page content -->
    <div class="main-container container top-20">
        <!-- Chat list   -->
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group list-group-flush bg-none rounded-0">
                    @foreach($absens as $month => $monthIzins)
                        <div class="list-group-item text-center py-2 text-opac">{{ $month }}</div>
                        @foreach($monthIzins as $absen)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-1 text-center">
                                        <i class="bi bi-person"></i>
                                        @if ($absen->kehadiran == 'tepat waktu')
                                        <p class="lh-small text-success">
                                        @elseif($absen->kehadiran == 'terlambat')
                                        <p class="lh-small text-warning">
                                        @else
                                        <p class="lh-small text-danger">
                                        @endif
                                            <b>{{ ucwords($absen->kehadiran) }}</b>
                                        </p>
                                    </div>
                                    <div class="col align-self-center">
                                        <p class="lh-small mb-0">
                                            <span><i class="bi bi-calendar-event"></i></span>
                                            <span>{{ \Carbon\Carbon::parse($absen->waktu_masuk)->format('d, F Y - H:i') }}</span>
                                            <span class="text-success">In</span>
                                            @if ($absen->waktu_keluar)
                                            <span> | </span>
                                            <span>{{ \Carbon\Carbon::parse($absen->waktu_keluar)->format('H:i') }}</span>
                                            <span class="text-danger">Out</span>
                                            @endif
                                        </p>
                                        <p class="small text-opac">{{ number_format($absen->jarak, 1) }} meter</p>
                                    </div>
                                    <div class="col-auto text-center">
                                        {{-- @if (!$absen->waktu_keluar)
                                            <a href="/absen/pulang/{{ $absen->hashid }}" class="btn btn-sm btn-info">Absen Pulang</a>
                                        @endif --}}
                                        <div class="avatar avatar-40 coverimg rounded-circle" style="background-image: url('assets/img/user1.jpg');">
                                            <i class="bi bi-{{ $absen->status == 'disetujui' ? 'check-circle text-success' : ($absen->status == 'tertunda' ? 'dash-circle text-warning' : 'x-circle text-danger') }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- main page content ends -->
</x-karyawan-layout>

