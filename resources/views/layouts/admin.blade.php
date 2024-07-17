<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="" />
    <title>{{ config('app.name', 'Super Apps PT.APM Logistics') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon180.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicon16.png') }}" sizes="16x16" type="image/png">

    {{-- PWA --}}
    <link rel="manifest" href="{{ asset('assets/js/manifest.json') }}">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
    <!-- izitoast css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/jquery-3.7.1.min.js') }}"></script>
    {{-- Toast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" type="text/javascript"></script>
    <style>
        table#datatablesSimple th,
        table#datatablesSimple td {
            text-align: center;
            vertical-align: middle;
        }
        @media print {
                @page {
                    margin: 10mm 5mm 10mm 5mm;
                    size: landscape;
                }
                body {
                    -webkit-print-color-adjust: exact;
                    margin: 0;
                    padding: 0;
                }
                .not-print {
                    display: none;
                }
                table {
                    margin-top: 20px;
                    width: 100%;
                    table-layout: auto;
                    border: 2px solid black
                }
                th, td {
                    word-wrap: normal;
                }
            }
    </style>
</head>
    <body>
        {{-- Navbar --}}
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark not-print">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Admin Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                {{-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> --}}
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            {{-- Sidebar --}}
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark not-print" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/admin/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Management</div>
                            {{-- User List --}}
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#user-sidebar" aria-expanded="false" aria-controls="user-sidebar">
                                <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                                List User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="user-sidebar" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/karyawan">Semua Karyawan</a>
                                    <a class="nav-link" href="/admin/karyawan/pending">Karyawan Pending</a>
                                </nav>
                            </div>
                            {{-- Absensi List --}}
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#absensi-sidebar" aria-expanded="false" aria-controls="absensi-sidebar">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                List Absensi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="absensi-sidebar" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/absen">History Absensi</a>
                                    <a class="nav-link" href="/admin/absen/request">Request Absensi</a>
                                </nav>
                            </div>
                            {{-- Perizinan List --}}
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#perizinan-sidebar" aria-expanded="false" aria-controls="perizinan-sidebar">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                List Perizinan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="perizinan-sidebar" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/admin/izin">Karyawan Izin</a>
                                <a class="nav-link" href="/admin/izin/request">Request Izin</a>
                            </nav>
                            </div>
                            <a class="nav-link" href="/admin/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-reports"></i></div>
                                Laporan Absensi
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            {{-- Content --}}
            <div id="layoutSidenav_content">
                {{ $slot }}
            </div>
        </div>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
        {{-- <script src="{{ asset('assets/admin/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/admin/assets/demo/chart-area-demo.js') }}assets/demo/chart-bar-demo.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/admin/js/datatables-simple-demo.js') }}"></script>
        <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
        <script>
            $(document).ready(function () {
                function showToast(type, title, message) {
                    iziToast[type]({
                        title: title,
                        message: message,
                        position: 'bottomRight'
                    });
                }

                @if(session('status'))
                    showToast('success', 'Success', '{{ session('status') }}');
                @endif

                @if(session('success'))
                    showToast('success', 'Success', '{{ session('success') }}');
                @endif

                @if(session('error'))
                    showToast('error', 'Error', '{{ session('error') }}');
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        showToast('error', 'Error', '{{ $error }}');
                    @endforeach
                @endif
            });
        </script>
    </body>
</html>
