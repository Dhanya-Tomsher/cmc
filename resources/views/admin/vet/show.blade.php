@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">Vet Details</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="caretaker_details.html">Vet Details</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a onclick="window.location=document.referrer;" href="javascript:void" href="javascript:void" class="btn btn_back waves-effect waves-light"> <i
                                class="uil-angle-left-b"></i> Back</a>
                        {{-- <div class="btn_group">
                            <a href="dashboard.html" class="btn btn_back waves-effect waves-light me-2"> Register Cat</a>
                            <a href="dashboard.html" class="btn btn_back waves-effect waves-light"> Blacklist </a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            <form action="#">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url('{{ $image }}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Name"
                                            value="{{ $vet[0]->name }}" id="Name" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea disabled required="" class="form-control" placeholder="Enter address" rows="2">{{ $vet[0]->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input disabled class="form-control" type="email" value="{{ $vet[0]->email }}"
                                            placeholder="Enter Email ID" id="Email">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input disabled class="form-control" value="{{ $vet[0]->phone_number }}" type="text"
                                            placeholder="Enter Phone Number" id="phone">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input disabled class="form-control" value="{{ $vet[0]->whatsapp_number }}"
                                            type="text" placeholder="Enter Whatsapp Number" id="whatsapp">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <select disabled class="form-select form-control">
                                            <option>{{ $vet[0]->country }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <select disabled class="form-select form-control">
                                            <option>{{ $vet[0]->emirate }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Gender</label>
                                        <select disabled class="form-select form-control" name="gender">
                                            <option>{{ $vet[0]->gender }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Name</label>
                                        <input disabled class="form-control" name="color_name" type="text"
                                            placeholder="Enter Color Name" value="{{ $vet[0]->color_name }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Code</label>
                                        <input disabled class="form-control" name="color_code" type="text"
                                            placeholder="Enter Color Code" value="{{ $vet[0]->color_code }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Emirates ID</label>
                                        <input disabled class="form-control" name="emirates_id" type="text"
                                            placeholder="Emirates ID" value="{{ $vet[0]->emirates_id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">License Number</label>
                                        <input disabled class="form-control" name="license_number" type="text"
                                            placeholder="Licence Number" value="{{ $vet[0]->license_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Designation</label>
                                        <input disabled class="form-control" name="designation" type="text"
                                            placeholder="Designation" value="{{ $vet[0]->designation }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Specialization</label>
                                        <input disabled class="form-control" name="specialization" type="text"
                                            placeholder="Specialization" value="{{ $vet[0]->specialization }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label">Shift Time</label>
                                        <input disabled class="form-control" name="shift_from" type="text"
                                            placeholder="Shift Time" value="{{ date('h:i a', strtotime($vet[0]->shift_from)) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label opacity-0">.</label>
                                        <input disabled class="form-control" name="specialization" type="text"
                                            placeholder="Shift Time" value="{{ date('h:i a', strtotime($vet[0]->shift_to)) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Status</label>
                                        <input disabled class="form-control" name="status" type="text"
                                            placeholder="Status" value="{{ ucfirst($vet[0]->status) }}">
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
