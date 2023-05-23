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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    @stack('header')
    <style>
    .ck-editor__editable_inline {
        height: 500px;
    }

    .border {
        border: 1px solid #ececec !important;
        padding: 2% 2% 2% !important;
    }

    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
    </style>
</head>

<body>

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        {{-- Main Content Start --}}
        <div class="main-content" style="margin: 2% 10% 2%;">
            <div class="">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body py-4">
                                    @if(isset($form[0]))
                                        @if(session()->has('success'))
                                        <div class="col-md-6 offset-md-3 alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2 border">
                                                <div class="col-md-12 text-center">
                                                    <h3>{{$form[0]['form_title']}}</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-md-12">
                                                    {!!$form[0]['form_content'] !!}
                                                </div>
                                                <hr>
                                                <div class="col-md-12">
                                                    <div class="col-md-5">
                                                        <label class="col-form-label"><b>Caretaker Name : </b></label>
                                                        {{$form[0]['caretaker_name']}}
                                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['caretaker_name']}}"> -->
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="col-form-label"><b>Cat Name : </b></label>
                                                        {{$form[0]['cat_name']}}
                                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['cat_name']}}"> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="col-md-5">
                                                        <label class="col-form-label"><b>Date : </b></label>
                                                        {{ ($form[0]['signed_status'] == 1) ? $form[0]['signed_date'] : '' }}
                                                        <!-- <input type="text" class="form-control me-auto" value="{{ date('Y-m-d') }}"> -->
                                                    </div>
                                                    <div class="col-md-7" @if($form[0]['signed_status']==0)
                                                        style="display:none;" @endif>
                                                        <label class="col-form-label"><b>Signature</b></label>
                                                        @if($form[0]['signed_status'] == 1 && $form[0]['signature_url'] !=
                                                        '')
                                                        <img src="{{ asset($form[0]['signature_url']) }}" class="w-80" />
                                                        @endif
                                                    </div>
                                                    <div class="col-md-7" @if($form[0]['signed_status']==1)
                                                        style="display:none;" @endif>
                                                        <form method="POST" action="{{ route('signaturepad.upload') }}">
                                                            @csrf
                                                            <input type="hidden" id="cid" name="cid"
                                                                value="{{ $form[0]['id'] }}">
                                                            <label class="col-form-label"><b>Signature</b></label>
                                                            <div id="sig"></div>
                                                            <button id="clear" class="btn btn-danger btn-sm">Clear
                                                                Signature</button>
                                                            <textarea id="signature64" name="signature"
                                                                style="display:none;"></textarea>
                                                            <div class="col-md-12 text-center mt-3 text-end">
                                                                <input type="submit"
                                                                    class="btn btn-primary waves-effect waves-light w-xl me-2"
                                                                    id="create_appoinment" value="Save" />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2 border">
                                            <div class="col-md-12 text-center">
                                                <h3>Not Found</h3>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div> <!-- container-fluid -->
            </div>
        </div>
        {{-- Main Content End --}}
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script type="text/javascript">
    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
    </script>
    @stack('footer')
    @stack('scripts')
</body>

</html>