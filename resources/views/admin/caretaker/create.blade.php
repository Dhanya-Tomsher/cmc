@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Register Caretaker'])
@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
<div class="div">
    <h4 class="mb-0">Caretaker Details</h4>
</div>

<div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><a href="{{ route('caretaker.index') }}">Caretaker Details</a></li>
                                            <li class="breadcrumb-item active">Caretaker Details Edit</li>
                                            
                                        </ol>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="{{ route('caretaker.index') }}" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
                                   <div class="btn_group">
                                    <a href="{{ route('cat.create') }}" class="btn btn_back waves-effect waves-light me-2">  Register Cat</a>
                                    <a href="{{ route('caretaker.index') }}" class="btn btn_back waves-effect waves-light">  Blacklist </a>
                                   </div>
                                </div>
                            </div>
                        </div> 
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <form name="frm" action="{{ route('caretaker.store') }}" enctype="multipart/form-data" method="POST">
                                        @csrf    
                                        <div class="row mb-3">
                                                <div class="col-6">
                                                    <div class="avatar-upload caretaker_dp">
                                                        <div class="avatar-edit">
                                                        <input type="file" class="sr-only" id="featuredImage" name="imageUrl"
                                        accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp">
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
                                                    <label for="example-text-input" class="col-form-label">Customer ID</label>
                                                    <input class="form-control" name="customer_id" type="text" id="example-text-input">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="Name" class="col-form-label">Name</label>
                                                    <input class="form-control" name="name" type="text" placeholder="Enter Name" id="Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">Address</label>
                                                    <textarea required="" name="address" class="form-control" placeholder="Enter address" rows="2"></textarea>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="email" class="col-form-label">Email ID</label>
                                                    <input class="form-control" name="email" type="email" placeholder="Enter Email ID" id="Email">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="phone" class="col-form-label">Phone Number</label>
                                                    <input class="form-control" name="phone_number" type="text" placeholder="Enter Phone Number" id="phone">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                                    <input class="form-control" name="whatsapp_number" type="text" placeholder="Enter Whatsapp Number" id="whatsapp">
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
                                                    <label for="country" class="col-form-label">Emirate</label>
                                                    <select class="form-select form-control" name="emirate">
                                                        <option>Select</option>
                                                        <option>Dubai</option>
                                                        <option>Abu Dhabi</option>
                                                        <option>Sharjah</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Work Place</label>
                                                    <input class="form-control" name="work_place" type="text" placeholder="Enter Work Place">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Work Address</label>
                                                    <input class="form-control" name="work_address" type="text" placeholder="Enter Work Address">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Position</label>
                                                    <input class="form-control" name="position" type="text" placeholder="Enter Position">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="work-number" class="col-form-label">Work Contact Number</label>
                                                    <input class="form-control" name="work_contact_number" type="text" placeholder="Enter Work Contact Number" id="work-number">
                                                </div>

                                                <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                                    <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                                                   <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PassportYes" name="is_passport_no" class="form-check-input"  value="show">
                                                        <label class="form-check-label" for="PassportYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline" >
                                                        <input type="radio" id="PassportNo" name="is_passport_no" class="form-check-input" value="hide" checked>
                                                        <label class="form-check-label" for="PassportNo">No</label>
                                                    </div>
                                                    <input class="form-control" name="passport_number" type="text" placeholder="Enter Passport No" id="input1" style="display: none;">
                                                   </div>
                                                </div>


                                                <div class="col-md-4 passport_input align-items-center" id="input3">
                                                    <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                                                   <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="EmiratesYes" name="is_emirates_id" class="form-check-input"  value="show">
                                                        <label class="form-check-label" for="EmiratesYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline" >
                                                        <input type="radio" id="EmiratesNo" name="is_emirates_id" class="form-check-input" value="hide" checked>
                                                        <label class="form-check-label" for="EmiratesNo">No</label>
                                                    </div>
                                                    <input class="form-control" name="emirates_id_number" type="text" placeholder="Enter Emirates ID" id="input2" style="display: none;">
                                                   </div>
                                                </div>

                                

                                                <div class="col-md-4">
                                                    <label for="country" class="col-form-label">Visa Status</label>
                                                    <select class="form-select form-control" name="visa_status">
                                                        <option>Select</option>
                                                        <option>Residence Visa</option>
                                                        <option>Tourist Visa</option>
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