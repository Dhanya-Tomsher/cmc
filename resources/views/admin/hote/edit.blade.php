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
                                            <li class="breadcrumb-item active">Vet Details Edit</li>
                                            
                                        </ol>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="caretaker_details.html" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
                                   <div class="btn_group">
                                    <a href="dashboard.html" class="btn btn_back waves-effect waves-light me-2">  Register Cat</a>
                                    <a href="dashboard.html" class="btn btn_back waves-effect waves-light">  Blacklist </a>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body py-4">
                                    <form name="frm" action="{{ route('vet.update', $vet) }}" enctype="multipart/form-data" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="avatar-upload caretaker_dp">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"><i class="uil uil-pen font-size-18"></i> </label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url('assets/images/users/avatar-3.jpg');">
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <label for="Name" class="col-form-label">Name</label>
                                                    <input class="form-control" value="{{ old('name', $vet->name) }}" name="name" type="text" placeholder="Enter Name" id="Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">Address</label>
                                                    <textarea required="" value="{{ old('address', $vet->address) }}" name="ddress" class="form-control" placeholder="Enter address" rows="2"></textarea>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="email" class="col-form-label">Email ID</label>
                                                    <input class="form-control" value="{{ old('email', $vet->email) }}" name="name" type="email" placeholder="Enter Email ID" id="Email">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="phone" class="col-form-label">Phone Number</label>
                                                    <input class="form-control" value="{{ old('phone_number', $vet->phone_number) }}" name="phone_number" type="text" placeholder="Enter Phone Number" id="phone">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                                    <input class="form-control" value="{{ old('whatsapp_number', $vet->whatsapp_number) }}" name="whatsapp_number" type="text" placeholder="Enter Whatsapp Number" id="whatsapp">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="country" class="col-form-label">Home Country</label>
                                                    <select class="form-select form-control" name="home_country">
                                                        <option>Select</option>
                                                        <option>United Arab Emirates</option>
                                                        <option>Bahrain</option>
                                                        <option>Oman</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="country" class="col-form-label">State</label>
                                                    <select class="form-select form-control" name="emirate">
                                                        <option>Select</option>
                                                        <option>Dubai</option>
                                                        <option>Abu Dhabi</option>
                                                        <option>Sharjah</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Name</label>
                                                    <input class="form-control" value="{{ old('name', $vet->name) }}" name="name" type="text" placeholder="Enter Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Color Name</label>
                                                    <input class="form-control" value="{{ old('color_name', $vet->color_name) }}" name="color_name" type="text" placeholder="Enter Color Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Color Code</label>
                                                    <input class="form-control" value="{{ old('color_code', $vet->color_code) }}" name="color_code" type="text" placeholder="Enter Color Code">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="work-number" class="col-form-label">Emirates ID</label>
                                                    <input class="form-control" value="{{ old('emirates_id', $vet->emirates_id) }}" name="emirates_id" type="text" placeholder="Emirates ID" id="work-number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="work-number" class="col-form-label">License Number</label>
                                                    <input class="form-control" value="{{ old('license_number', $vet->license_number) }}" name="license_number" type="text" placeholder="Licence Number" id="work-number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="work-number" class="col-form-label">Designation</label>
                                                    <input class="form-control" value="{{ old('designation', $vet->designation) }}" name="designation" type="text" placeholder="Designation" id="work-number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="work-number" class="col-form-label">Specialization</label>
                                                    <input class="form-control" value="{{ old('specialization', $vet->specialization) }}" name="specialization" type="text" placeholder="Emirates ID" id="work-number">
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