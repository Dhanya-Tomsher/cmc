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
</head> 
<body>
    <div class="">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row data_count">
                    <div class="col">
                        <div class="card">
                            <div class="card-body py-4">
                                <div class="float-end mt-2">
                                
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countNeutered }}</span></h4>
                                    <p class="text-muted mb-0">Total no. of Neutered Cats  </p>
                                </div>
                            
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col">
                        <div class="card">
                            <div class="card-body py-4">
                                <div class="float-end mt-2">
                                
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"> {{ $countSpayed }}</span></h4>
                                    <p class="text-muted mb-0">Total no. of Spayed Females </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
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