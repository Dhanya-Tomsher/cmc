@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Cat Details</h4>
                                
                                                                    <div class="page-title-right">
                                                                        <ol class="breadcrumb m-0">
                                                                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                                            <li class="breadcrumb-item active"><a href="{{ route('cat.index') }}">Cat Deatails</a></li>
                                                                            <li class="breadcrumb-item active">Cat Deatails Edit</li>
                                                                        </ol>
                                                                    </div>
                                
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                                    <a href="{{ route('cat.index') }}" class="btn btn_back waves-effect waves-light mt-3">  <i class="uil-angle-left-b"></i> Back</a>
                                                                   <div class="btn_group">
                                                                    <a href="hospital_appointments.html" class="btn btn_back waves-effect waves-light me-2">  Create Hospital Appointments </a>
                                                                    <a href="hotel_appointments.html" class="btn btn_back waves-effect waves-light" id="sa-warning">  Create Hotel Appointments  </a>
                                                                    <a href="journal.html" class="btn btn_back waves-effect waves-light" id="sa-warning">  Journal </a>
                                                                   </div>
                                                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">

<div class="d-flex justify-content-between align-items-center mb-2">
    <h6>Cat Details</h6>

</div>
<form name="frm" action="{{ route('cat.store') }}" enctype="multipart/form-data" method="POST">
                                        @csrf  
                                        <div class="card">
                                            <div class="card-body py-4">
                                             
                                                <div class="row mb-3">
                                                    <div class="col-6">

                                                        <div class="avatar-upload">

                                                            <div class="avatar-preview">
                                                                <div id="imagePreview" style="background-image: url('assets/images/cat_img.jpg');">
                                                                    <div class="edit_button">
                                                                        <a href="cat_details.html" class="btn btn-primary waves-effect waves-light py-2 float-end">Update</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="avatar-edit mt-2">
                                                            <input type="file" class="sr-only" id="featuredImage" name="imageUrl" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp">
                                                                <label for="imageUpload"> Upload Profile Image </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                      
        
                                                <div class="row">
                                                <div class="col-md-6">
                                                        <label for="example-text-input" class="col-form-label">Caretaker ID</label>
                                                        <input class="form-control" name="caretaker_id" type="text" id="example-text-input">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="example-text-input" class="col-form-label">Cat ID</label>
                                                        <input class="form-control" name="cat_id" type="text" id="example-text-input">
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="Name" class="col-form-label">Name</label>
                                                        <input class="form-control" name="name" type="text" placeholder="Enter Name" id="Name">
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="address" class="col-form-label">Date of Birth</label>
                                                        <div class="input-group" id="datepicker1">
                                                            <input type="text" name="date_birth" class="form-control" placeholder="dd mm, yyyy" data-date-format="dd M, yyyy" data-date-container="#datepicker1" data-provide="datepicker"  data-date-autoclose="true">        
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="emirates-id" class="col-form-label d-block">Gender</label>
                                                       <div class="d-flex h-50 align-items-center border-bottom-1">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="GenderMale" value="Male" name="gender" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="GenderMale">Male</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="GenderFemale" value="Female" name="gender" class="form-check-input" value="show">
                                                            <label class="form-check-label" for="GenderFemale">Female</label>
                                                        </div>
                                                       </div>
                                                    </div>


                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Pregnant / Not</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantYes" value="1" name="pregnantstatus" class="form-check-input">
                                                            <label class="form-check-label" for="PregnantYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantNo" value="0" name="pregnantstatus" class="form-check-input">
                                                            <label class="form-check-label" for="PregnantNo">No</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantUnknown" value="" name="pregnantstatus" class="form-check-input" checked>
                                                            <label class="form-check-label" for="PregnantUnknown">Unknown</label>
                                                        </div>
                                                       </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="emirates-id" class="col-form-label d-block">Bolod Type</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodA" value="A" name="blood_type" class="form-check-input">
                                                            <label class="form-check-label" for="BolodA">A</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodB" value="B" name="blood_type" class="form-check-input">
                                                            <label class="form-check-label" for="BolodB">B</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodAB" value="AB" name="blood_type" class="form-check-input">
                                                            <label class="form-check-label" for="BolodAB">AB</label>
                                                        </div>

                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodMic" value="mic" name="blood_type" class="form-check-input">
                                                            <label class="form-check-label" for="BolodMic">mic</label>
                                                        </div>

                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodUnknown" value="" name="blood_type" class="form-check-input" checked>
                                                            <label class="form-check-label" for="BolodUnknown">Unknown</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Neutered</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredYes" value="1" name="neutered" class="form-check-input">
                                                            <label class="form-check-label" for="NeuteredYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredNo" value="0" name="neutered" class="form-check-input" checked>
                                                            <label class="form-check-label" for="NeuteredNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Neutered with Us</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredWithYes" value="1" name="neutered_with_us" class="form-check-input">
                                                            <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredWithNo" value="0" name="neutered_with_us" class="form-check-input" checked>
                                                            <label class="form-check-label" for="NeuteredWithNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Spayed</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="SpayedYes" value="1" name="spayed" class="form-check-input">
                                                            <label class="form-check-label" for="SpayedYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="SpayedNo" value="0" name="spayed" class="form-check-input" checked>
                                                            <label class="form-check-label" for="SpayedNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="emirates-id" class="col-form-label d-block">Castrated</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="CastratedYes"  value="1" name="castrated" class="form-check-input">
                                                            <label class="form-check-label" for="CastratedYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="CastratedNo"  value="0" name="castrated" class="form-check-input" checked>
                                                             <label class="form-check-label" for="CastratedNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="FurColor" class="col-form-label">Fur / Color</label>
                                                        <input type="text" name="fur_color" class="form-control" id="FurColor" placeholder="Enter Fur / Color">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="EyeColor" class="col-form-label">Eye Color</label>
                                                        <input type="text" name="eye_color" class="form-control" id="EyeColor" placeholder="Enter Eye Color">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="country" class="col-form-label">Place of Orgin</label>
                                                        <select class="form-select form-control" name="place_of_origin">
                                                            <option>Select</option>
                                                            <option>United Arab Emirates</option>
                                                            <option>Bahrain</option>
                                                            <option>Oman</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="country" class="col-form-label">Emirate</label>
                                                        <select class="form-select form-control" name="emirate">
                                                            <option>Select</option>
                                                            <option>Dubai</option>
                                                            <option>Abu Dhabi</option>
                                                            <option>Sharjah</option>
                                                        </select>
                                                    </div>
    
                                                    <div class="col-md-12">
                                                        <label for="email" class="col-form-label">Orgin</label>
                                                        <input type="text" name="origin" class="form-control" placeholder="Enter Orgin">
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="phone" class="col-form-label">Microchip Number</label>
                                                        <input class="form-control" name="microchip_number" type="text" placeholder="Enter Microchip Number" id="phone">
                                                    </div>
                                                    
                                                    <div class="col-md-6 align-self-end">
                                                        <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="Alive" value="alive" name="dead_alive" class="form-check-input" checked>
                                                            <label class="form-check-label" for="Alive">Alive</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="Dead" value="dead" name="dead_alive" class="form-check-input">
                                                            <label class="form-check-label" for="Dead">Dead </label>
                                                        </div>

                                                       </div>
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
                            </div>

                            

               
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                @endsection
@push('header')
@endpush