<html>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <style>
        .data_count .card{
          padding: 130px;
        }

        .data_count .card h4 span{
          font-size: 100px;
        }

        .data_count .card p{
          font-size: 28px;
        }
        
        .bg {
        animation:slide 3s ease-in-out infinite alternate;
        background-image: linear-gradient(-60deg, #FFEFBA 50%, #FFFFFF 50%);
        bottom:0;
        left:-50%;
        opacity:.5;
        position:fixed;
        right:-50%;
        top:0;
        z-index:-1;
        }

        .bg2 {
        animation-direction:alternate-reverse;
        animation-duration:4s;
        }

        .bg3 {
        animation-duration:5s;
        }

        @keyframes slide {
        0% {
            transform:translateX(-25%);
        }
        100% {
            transform:translateX(25%);
        }
        }

    </style>
</head> 
<body>

<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="vh-100">
        <div class="page-content w-75 m-auto vh-100 p-0 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row data_count">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body py-4 text-center">
                                <div class="float-end mt-2">
                                
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countNeutered }}</span></h4>
                                    <p class="text-muted mb-0">Total no. of Neutered Cats  </p>
                                </div>
                            
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body py-4 text-center">
                                <div class="float-end mt-2">
                                
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"> {{ $countSpayed }}</span></h4>
                                    <p class="text-muted mb-0">Total no. of Spayed Females </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="float-end mt-2">
                        
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countCastrated }}</span></h4>
                                    <p class="text-muted mb-0">Total no. of Castrated Males</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row-->
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