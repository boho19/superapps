<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="Husni">
        <meta name="generator" content="">
        <title>{{ config('app.name', 'Super Apps PT.APM Logistics') }}</title>

        <!-- manifest meta -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        {{-- PWA --}}
        <link rel="manifest" href="{{ asset('assets/js/manifest.json') }}">

        <link rel="icon" href="{{ asset('assets/vendor/swiperjs-6.6.2/manifest.json') }}">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon180.png') }}" sizes="180x180">
        <link rel="icon" href="{{ asset('assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
        <link rel="icon" href="{{ asset('assets/img/favicon16.png') }}" sizes="16x16" type="image/png">

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap" rel="stylesheet">

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

    </head>

    <body class="body-scroll d-flex flex-column h-100 dark-bg bg1" data-page="signin">

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

        <!-- Begin page content -->
        <main class="container-fluid h-100 main-container">
            <div class="overlay-image text-end">
                <img src="../assets/img/orange-slice.png" class="orange-slice" alt="">
            </div>

            <div class="row h-100">
                <div class="col-12 text-center">
                    <div class="logo-small">
                        <img src="../assets/img/logo.png" alt="" class="img">
                        {{-- <h6>GO<br><small>APM</small></h6> --}}
                    </div>
                </div>
                <div class="col-12 mx-auto text-center">
                    <div class="row h-100">
                        {{ $slot }}
                    </div>
                </div>
                <div class="col-12 text-center align-self-end py-2">
                    <div class="row">
                        <div class="col text-center">
                            {{-- <a href="signup.html" class="btn btn-link px-0 ms-2"> <i class="bi bi-chevron-rigaht"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- <x-alert /> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
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
