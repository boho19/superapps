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
                            <form action="{{ url('admin/laporan') }}" method="POST" class="d-flex gap-4">
                                @csrf
                                <label for="karyawan" class="pt-1" style="white-space: nowrap; font-size: 0.875rem;">Karyawan</label>
                                <select name="karyawan" id="karyawan" class="form-control form-control-sm" style="font-size: 0.875rem;">
                                    <option value="">Semua Karyawan</option>
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->hashid }}" {{ old('karyawan') == $karyawan->hashid ? 'selected' : '' }}>{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>

                                <label for="start_date" class="pt-1" style="white-space: nowrap; font-size: 0.875rem;">Mulai Tanggal:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" style="font-size: 0.875rem;" value="{{ old('start_date') ?? date('Y-m-d') }}">

                                <label for="end_date" class="pt-1" style="white-space: nowrap; font-size: 0.875rem;">Sampai Tanggal:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" style="font-size: 0.875rem;" value="{{ old('end_date') ?? date('Y-m-d') }}">

                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            </form>
                        </div>

                        @if(isset($absens))
                        <hr class="not-print">
                        <div class="d-flex justify-content-end not-print">
                            <button class="btn btn-sm btn-warning not-print" onclick="window.print()">Print</button>
                        </div>
                        <div class="text-center" id="contentPrint">
                            <h2>Laporan Kehadiran Karyawan Periode {{ date('d', strtotime($start_date)) }} {{ date('F', strtotime($start_date)) }} - {{ date('d', strtotime($end_date)) }} {{ date('F', strtotime($end_date)) }} {{ date('Y', strtotime($end_date)) }}</h2>
                            <hr style="margin-bottom: 30px;">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center; width: 50px;">No</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center; width: 200px;">Nama</th>
                                        <th colspan="{{ \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date)) + 1 }}" style="text-align: center;">Tanggal</th>
                                    </tr>
                                    <tr>
                                        @php
                                            $startDate = \Carbon\Carbon::parse($start_date);
                                            $endDate = \Carbon\Carbon::parse($end_date);
                                        @endphp
                                        @for($date = $startDate; $date->lte($endDate); $date->addDay())
                                            <th style="text-align: center;">{{ $date->format('d') }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                @foreach($absens as $employeeId => $data)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama'] }}</td>
                                        @php
                                            $startDate = \Carbon\Carbon::parse($start_date);
                                            $endDate = \Carbon\Carbon::parse($end_date);
                                        @endphp
                                        @for($date = $startDate; $date->lte($endDate); $date->addDay())
                                            <td>{{ $data['days'][$date->format('Y-m-d')] }}</td>
                                        @endfor
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
