@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Hotel Rooms'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">Create New Rooms</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('hrooms.index') }}">Rooms</a>
                            </li>

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
                        @if(session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <form name="frm" action="{{ route('hrooms.store') }}" enctype="multipart/form-data"  method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Name" class="col-form-label">Room Number</label>
                                    <input class="form-control" name="room_number" value="{{ old('room_number') }}" type="text" placeholder="Enter Room Number" id="room_number">
                                    @error('room_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-4">
                                    <label for="address" class="col-form-label">Room Type</label>
                                    <select class="form-select form-control" name="room_type" id="room_type">
                                        <option value="">Select </option>
                                        <option {{ old('room_type') == 'hotel' ? 'selected' : '' }} value="hotel">Hotel</option>
                                        <option {{ old('room_type') == 'hospital' ? 'selected' : '' }} value="hospital">Hospital</option>
                                    </select>
                                    @error('room_type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> -->

                                <div class="col-md-4">
                                    <label for="email" class="col-form-label">Branch</label>
                                    <input class="form-control" name="branch" type="text" value="{{ old('branch') }}" placeholder="Enter Branch" id="branch">
                                </div>

                                <div class="col-md-4">
                                    <label for="phone" class="col-form-label">Amount</label>
                                    <input class="form-control" name="amount"  value="{{ old('amount') }}" type="text" placeholder="Enter Amount" id="amount">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="country" class="col-form-label">Status</label>
                                    <select class="form-select form-control" name="room_status" id="room_status">
                                        <option {{ old('room_status') == '1' ? 'selected' : '' }} value="1">Enabled</option>
                                        <option {{ old('room_status') == '0' ? 'selected' : '' }} value="0">Disabled</option>
                                    </select>
                                </div>

                                <div class="col-md-12 align-self-end mt-3">
                                    <div class="">
                                        <button name="Submit" type="Submit"
                                            class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->




    </div> <!-- container-fluid -->
</div>
@endsection
@push('header')
@endpush