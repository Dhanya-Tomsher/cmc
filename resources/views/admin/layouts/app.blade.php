<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}" />


    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      @stack('header')
</head>

<body>

<!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

    {{-- Header Start --}}
    @include('admin.parts.header')
    {{-- Header End --}}

    {{-- Sidebar Start --}}
    @include('admin.parts.sidebar') 
    {{-- Sidebar End --}}

    {{-- Main Content Start --}}
    <div class="main-content">
        @yield('content')
    </div>
    {{-- Main Content End --}}

    {{-- Footer Start --}}
    @include('admin.parts.footer')
    {{-- Footer End --}}
    </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/materialdesign.init.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->
    @stack('scripts')
</body>

</html>
