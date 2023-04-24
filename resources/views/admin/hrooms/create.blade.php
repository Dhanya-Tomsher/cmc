@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Hotel Rooms'])
@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
<div class="div">
    <h4 class="mb-0">Hotel Rooms Details</h4>
</div>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><a href="{{ route('hrooms.index') }}">Hotel Rooms</a></li>
                                            
                                        </ol>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="{{ route('hrooms.index') }}" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
                                   <div class="btn_group">
                                    <a href="{{ route('hrooms.create') }}" class="btn btn_back waves-effect waves-light me-2">  Create Hotel Rooms</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body py-4">
                                    <form name="frm" action="{{ route('hrooms.store') }}" enctype="multipart/form-data" method="POST">
                                           

                                            <div class="row">
                                            <div class="col-md-4">
                                                    <label for="Name" class="col-form-label">Room Number</label>
                                                    <input class="form-control" name="room_number" type="text" placeholder="Enter Room Number" id="Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">Room Type</label>
                                                    <textarea required="" name="room_type" class="form-control" placeholder="Enter Room Type" rows="2"></textarea>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="email" class="col-form-label">Facilities</label>
                                                    <input class="form-control" name="facilities" type="text" placeholder="Enter Facilities" id="Email">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="phone" class="col-form-label">Amount</label>
                                                    <input class="form-control" name="amount" type="text" placeholder="Enter Amount" id="phone">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="country" class="col-form-label">Room Status</label>
                                                    <select class="form-select form-control" name="room_status">
                                                        <option value="">Select</option>
                                                        <option value="1">Available</option>
                                                        <option value="0">Occupied</option>
                                                    </select>
                                                </div>                                              
                                              

                                                <div class="col-md-4 align-self-end mt-3">
<div class="">
<button name="Submit" type="Submit" class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
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