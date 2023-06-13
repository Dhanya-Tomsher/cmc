<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}" />


    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <style>
    body {
        margin: 0;
        padding: 0;
    }

    .main-warpper {
        background-color: #faf39f !important;
        background-image: linear-gradient(#faf39f, white);
    }

    .cont-text p {
        font-size: 60px;
        padding: 0;
        margin: 0;
    }

    .cont-text span {
        font-size: 60px;
    }
    </style>
</head>

<body>

    <div class="container-fluid pt-3"
        style="background-color: #faf39f !important;background-image: linear-gradient(#faf39f, white);">

        <div class="row">
            <div class="container" style="display: flex; justify-content: center">
                <a class="navbar-brand" href="https://tomsher.co/CMC" style="padding-top: 50px; padding-bottom: 200px;">
                    <img src="{{ asset('assets/images/logo.png') }}" style="max-width: 104%" />
                </a>
            </div>
            <!-- /navbar -->
        </div>

        <div class="row" style="display: flex; justify-content: space-around">
            <div class="col-xm-9 cont-text">
                <p>Total no. of neutered cats &nbsp;</p>
            </div>
            <div class="col-xm-3 cont-text">
                <span>{{ $countNeutered }}</span>
            </div>
        </div>
        <div class="row" style="display: flex; justify-content: space-around; margin: 30px 0;">
            <div class="col-xm-9 cont-text">
                <p>Total no. of spayed females
                </p>
            </div>
            <div class="col-xm-3 cont-text">
                <span>{{ $countSpayed }}</span>
            </div>
        </div>
        <div class="row" style="display: flex; justify-content: space-around">
            <div class="col-xm-9 cont-text">
                <p>Total no. of castrated males</p>
            </div>
            <div class="col-xm-3 cont-text">
                <span id="castrated">{{ $countCastrated }}</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/materialdesign.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>