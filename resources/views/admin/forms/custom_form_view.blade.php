@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Hotel Rooms'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">Customer Form Details</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">Custom Forms</a>
                            </li>

                        </ol>
                    </div>

                </div>
                
                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-60">
                        <a href="{{ route('custom-forms') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                    </div>
                    <div class="btn_group">
                        <a href="{{ route('custom-signature',$form[0]['id']) }}" target="_blank" class="btn btn_back waves-effect waves-light">Get Customer Signature Form</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
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
                                        <label class="col-form-label"><b>Caretaker Name : </b></label> {{$form[0]['caretaker_name']}}
                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['caretaker_name']}}"> -->
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-form-label"><b>Cat Name : </b></label> {{$form[0]['cat_name']}}
                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['cat_name']}}"> -->
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        <label class="col-form-label"><b>Date : </b></label> {{ ($form[0]['signed_status'] == 1) ? date('Y-m-d') : '' }}
                                        <!-- <input type="text" class="form-control me-auto" value="{{ date('Y-m-d') }}"> -->
                                    </div>
                                    <div class="col-md-7" @if($form[0]['signed_status'] == 0) style="display:none;" @endif>
                                        <label class="col-form-label"><b>Signature</b></label>
                                        @if($form[0]['signed_status'] == 1 && $form[0]['signature_url'] != '')
                                            <img src="{{ asset($form[0]['signature_url']) }}" class="w-80"/>
                                        @endif
                                    </div>
                                    <div class="col-md-7" style="display:none;">
                                        <form method="POST" action="{{ route('signaturepad.upload') }}">
                                            @csrf
                                            <input type="hidden" id="cid" name="cid" value="{{ $form[0]['id'] }}">
                                            <label class="col-form-label"><b>Signature</b></label>
                                            <div id="sig" ></div>
                                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                            <textarea id="signature64" name="signature" style="display:none;" ></textarea>
                                            <div class="col-md-12 text-center mt-3 text-end">
                                                <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Save"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection
@push('header')
<style>
.ck-editor__editable_inline {
    height: 500px;
}
.border{
    border: 1px solid #ececec !important;
    padding : 2% 2% 2% !important;
}
.kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}
</style>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
</script>
@endpush