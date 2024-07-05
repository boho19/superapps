<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>{{ config('app.name', 'Super Apps PT.APM Logistics') }}</title>

        <!-- manifest meta -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="{{ asset('assets/vendor/swiperjs-6.6.2/manifest.json') }}">

        {{-- PWA --}}
        <link rel="manifest" href="{{ asset('assets/js/manifest.json') }}">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon180.png') }}" sizes="180x180">
        <link rel="icon" href="{{ asset('assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{ asset('assets/img/favicon16.png') }}" sizes="16x16" type="image/png">

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap"
            rel="stylesheet">

        <!-- bootstrap icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- nouislider CSS -->
        <link href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}" rel="stylesheet">

        <!-- swiper css -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

        <!-- izitoast css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

        <!-- style css for this template -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" id="style">

        <!-- Webcam.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    </head>

    <body class="body-scroll" data-page="stats">

        <!-- loader section -->
        <div class="container-fluid loader-wrap">
            <div class="row h-100">
                <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                    <div class="loader-cube-wrap mx-auto">
                        <div class="loader-cube1 loader-cube"></div>
                        <div class="loader-cube2 loader-cube"></div>
                        <div class="loader-cube4 loader-cube"></div>
                        <div class="loader-cube3 loader-cube"></div>
                    </div>
                    <p>Let's Create Difference<br><strong>Please wait...</strong></p>
                </div>
            </div>
        </div>
        <!-- loader section ends -->

        <!-- Sidebar main menu -->
        <div class="sidebar-wrap  sidebar-overlay">
            <!-- Add pushcontent or fullmenu instead overlay -->
            <div class="closemenu text-opac">Close Menu</div>
            <div class="sidebar">
                <div class="row mt-4 mb-3">
                    <div class="col-auto">
                        <figure class="avatar avatar-60 rounded mx-auto my-1">
                            <img src="{{ asset('assets/img/profile').'/'.Auth::user()->karyawan->foto }}" alt="">
                        </figure>
                    </div>
                    <div class="col align-self-center ps-0">
                        <h6 class="mb-0">{{ ucwords(Auth::user()->karyawan->nama) }}</h6>
                        <p class="text-opac">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                    <div class="col">Dashboard</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-bell"></i></div>
                                    <div class="col">Absen</div>
                                    <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item nav-link {{ Request::is('abseen.create') ? 'active' : '' }}" href="/absen/create">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-bag"></i></div>
                                            <div class="col">Create</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a></li>
                                    <li><a class="dropdown-item nav-link {{ Request::is('absen') ? 'active' : '' }}" href="/absen">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-binoculars"></i>
                                            </div>
                                            <div class="col">History</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-file-earmark-text"></i></div>
                                    <div class="col">Izin</div>
                                    <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item nav-link {{ Request::is('izin.create') ? 'active' : '' }}" href="/izin/create">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-chat-text"></i></div>
                                            <div class="col">Create</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a></li>
                                    <li><a class="dropdown-item nav-link {{ Request::is('izin') ? 'active' : '' }}" href="/izin">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-file"></i></div>
                                            <div class="col">History</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/logout" tabindex="-1">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                                    <div class="col">Logout</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar main menu ends -->

        <!-- Begin page -->
        <main class="h-100 has-header has-footer">

            <!-- Navbar -->
            <header class="container-fluid header">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <button type="button" class="btn btn-link menu-btn text-color-theme">
                            <i class="bi bi-list size-24"></i>
                        </button>
                    </div>
                    <div class="col text-center">
                        <div class="logo-small">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img">
                            <h6>GO<br><small>MobileUX</small></h6>
                        </div>
                    </div>
                    <div class="col-auto align-self-center">
                        <a href="#" class="link text-color-theme">
                            <i class="bi bi-person-circle size-22"></i>
                        </a>
                    </div>
                </div>
            </header>
            <!-- Navbar ends -->

            <!-- main page content -->
            <div class="main-container container">
                <div class="row mb-4">
                    {{ $slot }}
                </div>
            </div>
            <!-- main page content ends -->
        </main>
        <!-- Page ends-->

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <div>
                                <i class="nav-icon bi bi-house"></i>
                                <span class="nav-text">Home</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('absen') || Request::is('absen/create') ? 'active' : '' }}" href="/absen">
                            <div>
                                <i class="nav-icon bi bi-bar-chart-line"></i>
                                <span class="nav-text">Absensi</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('izin') || Request::is('izin/create') ? 'active' : '' }}" href="/izin">
                            <div>
                                <i class="nav-icon bi bi-file-earmark-text"></i>
                                <span class="nav-text">Perizinan</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') || Request::is('profile/edit') ? 'active' : '' }}" href="{{ url('profile') }}">
                            <div>
                                <i class="nav-icon bi bi-person-circle"></i>
                                <span class="nav-text">Profile</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
        <!-- Footer ends-->



        <!-- Required jquery and libraries -->
        <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

        <!-- cookie js -->
        <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

        <!-- PWA app service registration and works -->
        <script src="{{ asset('assets/js/pwa-services.js') }}"></script>

        <!-- swiper script -->
        <script src="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js') }}"></script>

        <!-- nouislider js -->
        <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>

        <!-- Customized jquery file  -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/color-scheme.js') }}"></script>

        <!-- page level custom script -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        {{-- toast --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" type="text/javascript"></script>
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
