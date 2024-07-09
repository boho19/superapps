<x-admin-layout>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4 not-print">Laporan</h1>
            <ol class="breadcrumb mb-4 not-print">
                <li class="breadcrumb-item active">Laporan Absensi</li>
            </ol>
            <hr class="not-print">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card-body">
                        <div class="container w-full not-print">
                            <h5>Periode:</h5>
                            <form action="{{ url('admin/laporan') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <label for="month" class="pt-1">Bulan:</label>
                                <select name="month" id="month" class="form-control">
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $m == (old('month') ?? date('n')) ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="year" class="pt-1">Tahun:</label>
                                <select name="year" id="year" class="form-control">
                                    @foreach(range(2020, date('Y')) as $y)
                                        <option value="{{ $y }}" {{ $y == (old('year') ?? date('Y')) ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            </form>
                        </div>

                        @if(isset($absens))
                        <hr class="not-print">
                        <div class="d-flex justify-content-end not-print">
                            <button class="btn btn-sm btn-warning not-print" onclick="window.print()">Print</button>
                        </div>
                        <div class="text-center" id="contentPrint">
                            <h2>Laporan Kehadiran Karyawan Periode {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}</h2>
                            <hr style="margin-bottom: 30px;">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">No</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Nama</th>
                                        <th colspan="{{ \Carbon\Carbon::create($year, $month)->daysInMonth }}" style="text-align: center;">Tanggal</th>
                                    </tr>
                                    <tr>
                                        @for($day = 1; $day <= \Carbon\Carbon::create($year, $month)->daysInMonth; $day++)
                                            <th style="text-align: center;">{{ $day }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                @foreach($absens as $employeeId => $data)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama'] }}</td>
                                        @foreach($data['days'] as $day => $time)
                                            <td>{{ $time }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>
