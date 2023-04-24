@extends('admin.layouts.app', ['body_class' => '', 'title' => 'View Castrated'])
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
                                            <li class="breadcrumb-item active"><a href="dashboard.html">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Cat Deatails</li>
                                        </ol>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="register_cat.html" class="btn btn_back waves-effect waves-light mt-3">  <i class="uil-angle-left-b"></i> Back</a>
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <h6>Cat Details</h6>
                                        </div>

                                        <div class="card">
                                            <div class="card-body py-4">

                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <div class="avatar-upload">
                                                            <div class="avatar-preview">
                                                                <div id="imagePreview" style="background-image: url('assets/images/cat_img.jpg');">
                                                                    <div class="edit_button">
                                                                        <a href="cat_details_edit.html" class="btn btn-primary waves-effect waves-light py-2 float-end"> <i class="uil uil-pen font-size-18"></i> Edit</a>
            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="example-text-input" class="col-form-label">Cat ID</label>
                                                        <input class="form-control" type="text" value="10005" readonly id="example-text-input">
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="Name" class="col-form-label">Name</label>
                                                        <input class="form-control" type="text" value="Asher" id="Name" readonly>
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="address" class="col-form-label">Date of Birth</label>
                                                        <div class="input-group" id="datepicker1">
                                                            <input type="text" class="form-control" value="07-04-2019" readonly>
                                                        </div>
                                                        <span>3 years 10 months 20 days</span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="emirates-id" class="col-form-label d-block">Gender</label>
                                                       <div class="d-flex h-50 align-items-center border-bottom-1">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="GenderMale" name="GenderName" class="form-check-input" value="hide" checked>
                                                            <label class="form-check-label" for="GenderMale">Male</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="GenderFemale" name="GenderName" class="form-check-input" value="show" disabled>
                                                            <label class="form-check-label" for="GenderFemale">Female</label>
                                                        </div>
                                                       </div>
                                                    </div>


                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Pregnant / Not</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantYes" name="pregnantstatus" class="form-check-input">
                                                            <label class="form-check-label" for="PregnantYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantNo" name="pregnantstatus" class="form-check-input">
                                                            <label class="form-check-label" for="PregnantNo">No</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="PregnantUnknown" name="pregnantstatus" class="form-check-input" checked>
                                                            <label class="form-check-label" for="PregnantUnknown">Unknown</label>
                                                        </div>
                                                       </div>
                                                    </div>


                                                    <div class="col-md-6 mt-2">
                                                        <label for="emirates-id" class="col-form-label d-block">Bolod Type</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodA" name="bolodtype" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="BolodA">A</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodB" name="bolodtype" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="BolodB">B</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodAB" name="bolodtype" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="BolodAB">AB</label>
                                                        </div>

                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodMic" name="bolodtype" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="BolodMic">mic</label>
                                                        </div>

                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="BolodUnknown" name="bolodtype" class="form-check-input" checked>
                                                            <label class="form-check-label" for="BolodUnknown">Unknown</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Neutered</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredYes" name="NeuteredStatus" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="NeuteredYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredNo" name="NeuteredStatus" class="form-check-input" checked>
                                                            <label class="form-check-label" for="NeuteredNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Neutered with Us</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredWithYes" name="neuteredwith" class="form-check-input">
                                                            <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="NeuteredWithNo" name="neuteredwith" class="form-check-input" checked>
                                                            <label class="form-check-label" for="NeuteredWithNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6 input4" style="display: none;">
                                                        <label for="emirates-id" class="col-form-label d-block">Spayed</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="SpayedYes" name="spayedstatus" class="form-check-input">
                                                            <label class="form-check-label" for="SpayedYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="SpayedNo" name="spayedstatus" class="form-check-input" checked>
                                                            <label class="form-check-label" for="SpayedNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="emirates-id" class="col-form-label d-block">Castrated</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="CastratedYes" name="castratedstatus" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="CastratedYes">Yes</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="CastratedNo" name="castratedstatus" class="form-check-input" checked>
                                                            <label class="form-check-label" for="CastratedNo">No</label>
                                                        </div>
                                                       </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="FurColor" class="col-form-label">Fur / Color</label>
                                                        <textarea class="form-control" id="FurColor" placeholder="Red (Ginger)" readonly  rows="2"></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="EyeColor" class="col-form-label">Eye Color</label>
                                                        <textarea class="form-control" id="EyeColor" placeholder="Hazel-Eyed" readonly rows="2"></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="country" class="col-form-label">Place of Orgin</label>
                                                        <input type="text" class="form-control" value="United Arab Emirates" readonly>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="country" class="col-form-label">Emirate</label>
                                                        <input type="text" class="form-control" value="Dubai" readonly >
                                                    </div>
    
                                                    <div class="col-md-12">
                                                        <label for="email" class="col-form-label">Orgin</label>
                                                        <textarea class="form-control" rows="2" placeholder="D 63 (Umm Suqeim Road/Al Qudra Road)" ></textarea>
                                                    </div>
    
                                                    <div class="col-md-6">
                                                        <label for="phone" class="col-form-label">Microchip Number</label>
                                                        <input class="form-control" type="text" value="9000020000603477" readonly id="phone">
                                                    </div>
                                                    
                                                    <div class="col-md-6 align-self-end">
                                                        <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                                                       <div class="d-flex align-items-center">
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="Alive" name="deadalive" class="form-check-input" checked>
                                                            <label class="form-check-label" for="Alive">Alive</label>
                                                        </div>
                                                        <div class="custom-radio form-check form-check-inline">
                                                            <input type="radio" id="Dead" name="deadalive" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="Dead">Dead </label>
                                                        </div>

                                                       </div>
                                                    </div>

                                                </div>
        
                                            </div>
                                        </div>
                                    </div> <!-- end col-->
                                    
                                </div> <!-- end row-->
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">

                                        <h6>Caretaker Details</h6>
                                        <div class="card">
                                           
                                            <div class="card-body py-4">
    
        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="#">
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <div class="avatar-upload caretaker_dp">
                                                                        <div class="avatar-preview">
                                                                            <div id="imagePreview" style="background-image: url('assets/images/users/avatar-2.jpg');">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                        
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="example-text-input" class="col-form-label">Customer ID</label>
                                                                    <input class="form-control" type="text" value="10005" readonly id="example-text-input">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="Name" class="col-form-label">Name</label>
                                                                    <input class="form-control" type="text" value="Vanessa Jensen" readonly id="Name">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="address" class="col-form-label">Address</label>
                                                                    <input class="form-control" type="text" value="Al Murooj" readonly id="address">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="email" class="col-form-label">Email ID</label>
                                                                    <input class="form-control" type="email" value="vanessajensen@gmail.com" readonly id="Email">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="phone" class="col-form-label">Phone Number</label>
                                                                    <input class="form-control" type="text" value="0522045888" readonly id="phone">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                                                    <input class="form-control" type="text" value="0522045888" readonly id="whatsapp">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="country" class="col-form-label">Home Country</label>
                                                                    <input class="form-control" type="text" value="United Arab Emirates" readonly id="country">
                                                                </div>
                
                                                                
                                                                <div class="col-md-6">
                                                                    <label for="Emirate" class="col-form-label">Emirate</label>
                                                                    <input class="form-control" type="text" value="Dubai" readonly id="Emirate">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="WorkPlace" class="col-form-label d-block">Work Place</label>
                                                                    <input class="form-control" type="text" value="Leminar Group" id="WorkPlace" readonly>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="WorkAddress" class="col-form-label d-block">Work Address</label>
                                                                    <input class="form-control" type="text" value="Al Quasis Dubai, United Arab Emirates" id="WorkAddress" readonly>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="Position" class="col-form-label d-block">Position</label>
                                                                    <input class="form-control" type="text" value="Sales Manager" id="Position" readonly>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="WorkContact" class="col-form-label d-block">Work Contact Number</label>
                                                                    <input class="form-control" type="text" value="+971 55 820 2720" id="WorkContact" readonly>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                                                                    <input class="form-control" type="text" value="ZK8K81602" id="emirates-id" readonly>
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="VisaStatus" class="col-form-label">Visa Status</label>
                                                                    <input class="form-control" type="text" value="Residence Visa" readonly id="VisaStatus">
                                                                </div>
                
                                                                <div class="col-md-6">
                                                                    <label for="registered-cats" class="col-form-label">No of Registered Cats</label>
                                                                    <input class="form-control" type="text" value="1" id="registered-cats" readonly>
                                                                </div>
                
                                                                <div class="col-md-4 align-self-end">
                
                                                                </div>
                                                            </div>
                
                                                        </form>
                                                    </div> <!-- end col-->
                                                </div> <!-- end row-->
        
                                            </div>
                                        </div>
                                    </div> <!-- end col-->
                                </div> <!-- end row-->


                            </div>
                        </div>

               
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                @endsection
@push('header')
@endpush