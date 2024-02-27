@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Hotel Rooms'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">Rooms Details</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rooms</li>
                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a onclick="window.location=document.referrer;" href="javascript:void" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="Name" class="col-form-label">Room Number</label>
                                <input class="form-control" name="room_number" readonly value="{{ $hrooms->room_number }}" type="text" id="room_number">
                            </div>

                            <!-- <div class="col-md-4">
                                <label for="address" class="col-form-label">Room Type</label>
                                <input class="form-control" name="room_type" readonly value="{{ ucfirst($hrooms->room_type) }}" type="text">
                            </div> -->

                            <div class="col-md-4">
                                <label for="email" class="col-form-label">Branch</label>
                                <input class="form-control" name="branch" readonly type="text" value="{{ $hrooms->branch }}" id="branch">
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="col-form-label">Amount</label>
                                <input class="form-control" name="amount" readonly value="{{ $hrooms->amount }}" type="text" id="phone">
                            </div>

                            <div class="col-md-4">
                                <label for="country" class="col-form-label">Status</label>
                                <input class="form-control" name="room_status" readonly value="{{ ($hrooms->room_status == 1) ? 'Enabled' : 'Disabled' }}" type="text" id="phone">
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
@endpush