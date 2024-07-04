<x-karyawan-layout>
    <h3 class="mb-2 text-center">List History Perizinan</h3>
    <a href="/izin/create" class="btn-login btn btn-lg btn-default shadow-sm mb-5">Buat Izin</a>
    <!-- main page content -->
    <div class="main-container container top-20">
        <!-- Chat list -->
        <div class="row">
            <div class="col-12 px-0">
                <div class="list-group list-group-flush bg-none rounded-0">
                    @foreach($izins as $month => $monthIzins)
                        <div class="list-group-item text-center py-2 text-opac">{{ $month }}</div>
                        @foreach($monthIzins as $izin)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-auto text-center">
                                        <i class="bi bi-person"></i>
                                        <p class="lh-small text-{{ $izin->keterangan == 'sakit' ? 'primary' : ($izin->keterangan == 'cuti' ? 'warning' : 'default') }}">
                                            <b>{{ $izin->keterangan }}</b>
                                        </p>
                                    </div>
                                    <div class="col align-self-center">
                                        <p class="lh-small mb-0">
                                            <span><i class="bi bi-calendar-event"></i></span>
                                            {{ \Carbon\Carbon::parse($izin->mulai)->format('d, F Y') }}
                                            <span>-</span>
                                            {{ \Carbon\Carbon::parse($izin->selesai)->format('d, F Y') }}
                                            <span class="small text-opac">
                                                {{ \Carbon\Carbon::parse($izin->mulai)->diffInDays(\Carbon\Carbon::parse($izin->selesai)) }} days
                                            </span>
                                        </p>
                                        <p class="small text-opac">{{ $izin->alasan }}</p>
                                    </div>
                                    <div class="col-auto text-center">
                                        <div class="avatar avatar-40 coverimg rounded-circle" style="background-image: url('assets/img/user1.jpg');">
                                            <i class="bi bi-{{ $izin->status == 'disetujui' ? 'check-circle text-success' : ($izin->status == 'tertunda' ? 'dash-circle text-warning' : 'x-circle text-danger') }}"></i>
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
