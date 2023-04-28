@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Hospital Appointments </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hospital Appointments</li>
                        </ol>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="#" class="btn btn_back waves-effect waves-light" data-bs-toggle="modal" id="new_appointment"
                        data-bs-target=".bs-example-modal-xl">Create Hospital Appointments</a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="external-events">
                            <div class="card-body">
                                <div id="appointment_calendar"></div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                </div>

                <div style='clear:both'></div>


                <!-- Add New Event MODAL --> 
                <div class="modal fade bs-example-modal-xl" id="createAppointmentModal" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myExtraLargeModalLabel">Create Hospital Appointments </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs border-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="caretaker_tab" data-bs-toggle="tab" href="#navtabs-care-taker"
                                            role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Care Taker Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cat_tab"  href="#navtabs-cat-details"
                                            role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Cat Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="appointment_tab"  href="#navtabs-appointment" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">Appointment</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content py-3 text-muted">
                                    <div class="tab-pane active" id="navtabs-care-taker" role="tabpanel">
                                        <h4 class="card-title mb-2">Search Caretaker</h4>
                                       
                                        <div class="hstack gap-3">
                                            <select class="form-control me-auto" placeholder="Search by : Reg No, Name, Mobile Number, ED"
                                                aria-label="Add your item here..." name="search_caretaker" id="search_caretaker" style="width: 80%">
                                            
                                            </select>
                                            <!-- <button class="btn btn-primary waves-effect waves-light w-xl">Search Caretaker</a> -->
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="col-form-label">Customer ID</label>
                                                <input class="form-control" type="text" value="" placeholder="Customer ID" readonly name="customer_id" id="customer_id">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Name" class="col-form-label">Name</label>
                                                <input class="form-control" type="text" placeholder="Name" readonly name="name" id="name">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="address" class="col-form-label">Address</label>
                                                <textarea required="" class="form-control" id="address" name="address" readonly placeholder="address" rows="1"></textarea>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="email" class="col-form-label">Email ID</label>
                                                <input class="form-control" type="email" placeholder="Email ID" readonly  id="email" name="email" >
                                            </div>

                                            <div class="col-md-4">
                                                <label for="phone" class="col-form-label">Phone Number</label>
                                                <input class="form-control" type="text" placeholder="Phone Number" readonly id="phone" name="phone">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                                <input class="form-control" type="text"  placeholder="Whatsapp Number" readonly id="whatsapp" name="whatsapp">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Home Country</label>
                                                <input class="form-control" type="text"  placeholder="Whatsapp Number" readonly id="country" name="country" >
                                            </div>
                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Emirate</label>
                                                <input class="form-control" type="text"  placeholder="Emirate" readonly id="emirate" name="emirate" >
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label">Work Place</label>
                                                <input class="form-control" type="text" placeholder="Work Place" readonly id="work_place" name="work_place">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label">Work Address</label>
                                                <input class="form-control" type="text" id="work_address" name="work_address" readonly placeholder="Work Address">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="col-form-label">Position</label>
                                                <input class="form-control" type="text" id="position" name="position" readonly placeholder="Position">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="work-number" class="col-form-label">Work Contact</label>
                                                <input class="form-control" type="text" placeholder="Work Contact" readonly id="work_number" name="work_number">
                                            </div>

                                            <div class="col-md-4 passport_input align-items-center"
                                                id="myRadioGroup">
                                                <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PassportYes" name="showHideTextbox"  disabled class="form-check-input" value="show">
                                                        <label class="form-check-label" for="PassportYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PassportNo" name="showHideTextbox" disabled class="form-check-input" value="hide" checked>
                                                        <label class="form-check-label" for="PassportNo">No</label>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Passport No" readonly id="passport_no" name="passport_no" style="display: none;">
                                                </div>
                                            </div>


                                            <div class="col-md-4 passport_input align-items-center" id="input3">
                                                <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="EmiratesYes" name="showHideTextbox2" disabled class="form-check-input" value="show">
                                                        <label class="form-check-label" for="EmiratesYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="EmiratesNo" name="showHideTextbox2" disabled class="form-check-input" value="hide" checked>
                                                        <label class="form-check-label" for="EmiratesNo">No</label>
                                                    </div>
                                                    <input class="form-control" type="text" placeholder="Emirates ID" readonly  id="emirates_id" name="emirates_id" style="display: none;">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Visa Status</label>
                                                <input class="form-control" type="text" placeholder="Work Contact" readonly id="visa_type" name="visa_type">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-cat-details" role="tabpanel">

                                        <h4 class="card-title mb-2">Search Cat</h4>
                                       
                                        <div class="hstack gap-3">
                                            <select class="form-control me-auto" placeholder="Search by : Name, Id"
                                                aria-label="Add your item here..." name="search_cat" id="search_cat" style="width: 80%">
                                            
                                            </select>
                                            <!-- <button  class="btn btn-primary waves-effect waves-light w-xl">Search Cat</button> -->
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="col-form-label">Cat ID</label>
                                                <input class="form-control" type="text" value="" placeholder="Cat ID"  readonly id="cat_id" name="cat_id">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="Name" class="col-form-label">Name</label>
                                                <input class="form-control" type="text" readonly placeholder="Name" id="cat_name" name="cat_name">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="address" class="col-form-label">Date of Birth</label>
                                                <div class="input-group" id="datepicker1">
                                                    <input type="text" class="form-control" placeholder="dd mm, yyyy" data-date-format="dd M, yyyy" id="date_of_birth"
                                                    readonly data-date-container="#datepicker1" data-provide="datepicker" data-date-autoclose="true" name="date_of_birth">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="emirates-id" class="col-form-label d-block">Gender</label>
                                                <div class="d-flex h-50 align-items-center border-bottom-1">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="cat_gender" name="GenderName" disabled  value="Male"  class="form-check-input" value="hide" checked>
                                                        <label class="form-check-label" for="GenderMale">Male</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="cat_gender" name="GenderName" disabled  value="Female" class="form-check-input" value="show">
                                                        <label class="form-check-label"  for="GenderFemale">Female</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4 input4" style="display: none;" id="pregnant-div">
                                                <label for="emirates-id" class="col-form-label d-block">Pregnant /  Not</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PregnantYes" name="pregnantstatus"  value="1"  disabled class="form-check-input">
                                                        <label class="form-check-label" for="PregnantYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PregnantNo" name="pregnantstatus"  value="0"  disabled class="form-check-input">
                                                        <label class="form-check-label" for="PregnantNo">No</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="PregnantUnknown"  name="pregnantstatus"  value="2"  disabled class="form-check-input" checked>
                                                        <label class="form-check-label"  for="PregnantUnknown">Unknown</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <label for="emirates-id" class="col-form-label d-block">Blood Type</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="bloodA" name="bloodtype"  value="a" disabled class="form-check-input">
                                                        <label class="form-check-label" for="bloodA">A</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="bloodB" name="bloodtype"  value="b" disabled class="form-check-input">
                                                        <label class="form-check-label" for="bloodB">B</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="bloodAB" name="bloodtype"  value="ab" disabled class="form-check-input">
                                                        <label class="form-check-label" for="bloodAB">AB</label>
                                                    </div>

                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="bloodMic" name="bloodtype"  value="mic" disabled class="form-check-input">
                                                        <label class="form-check-label" for="bloodMic">mic</label>
                                                    </div>

                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="bloodUnknown" name="bloodtype"  value="unknown" disabled class="form-check-input" checked>
                                                        <label class="form-check-label" for="bloodUnknown">Unknown</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 input4" style="display: none;" id="neutered-div">
                                                <label for="emirates-id" class="col-form-label d-block">Neutered</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="NeuteredYes" name="NeuteredStatus"  value="1" disabled class="form-check-input">
                                                        <label class="form-check-label" for="NeuteredYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="NeuteredNo" name="NeuteredStatus"  value="0"  disabled class="form-check-input" checked>
                                                        <label class="form-check-label" for="NeuteredNo">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 input4" style="display: none;"  id="neutered-with-us-div">
                                                <label for="emirates-id" class="col-form-label d-block">Neutered  with Us</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="NeuteredWithYes" name="neuteredwith" value="1" disabled class="form-check-input">
                                                        <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="NeuteredWithNo" name="neuteredwith" value="0" disabled class="form-check-input" checked>
                                                        <label class="form-check-label"  for="NeuteredWithNo">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 input4" style="display: none;"  id="spayed-div">
                                                <label for="emirates-id"
                                                    class="col-form-label d-block">Spayed</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="SpayedYes" name="spayedstatus" value="1" disabled class="form-check-input">
                                                        <label class="form-check-label" for="SpayedYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="SpayedNo" name="spayedstatus" value="0" disabled class="form-check-input" checked>
                                                        <label class="form-check-label" for="SpayedNo">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="emirates-id"
                                                    class="col-form-label d-block">Castrated</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="CastratedYes" name="castratedstatus" value="1" disabled class="form-check-input">
                                                        <label class="form-check-label" for="CastratedYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="CastratedNo" name="castratedstatus" value="0" disabled class="form-check-input" checked>
                                                        <label class="form-check-label" for="CastratedNo">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="FurColor" class="col-form-label">Fur / Color</label>
                                                <input type="text" class="form-control" id="fur_color" name="fur_color" readonly placeholder="Fur / Color" rows="1"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="EyeColor" class="col-form-label">Eye Color</label>
                                                <input type="text" class="form-control" id="eye_color" name="eye_color" readonly placeholder="Eye Color" rows="1"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Place of Origin</label>
                                                <input type="text" class="form-control" id="place_of_origin" name="place_of_origin" placeholder="Place of Origin" readonly  rows="1"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="country" class="col-form-label">Emirate</label>
                                                <input type="text" class="form-control" id="cat_emirate" name="cat_emirate" placeholder="Emirate" readonly  rows="1"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="email" class="col-form-label">Origin</label>
                                                <input type="text" class="form-control" rows="1" id="cat_origin" name="cat_origin" readonly placeholder="Origin"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="phone" class="col-form-label">Microchip Number</label>
                                                <input class="form-control" type="text" placeholder="Microchip Number" readonly id="microchip" name="microchip">
                                            </div>

                                            <div class="col-md-4 align-self-end">
                                                <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="alive" name="deadalive" value="1" disabled class="form-check-input" checked>
                                                        <label class="form-check-label" for="Alive">Alive</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="dead" name="deadalive" value="0" disabled class="form-check-input">
                                                        <label class="form-check-label" for="Dead">Dead </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="navtabs-appointment" role="tabpanel">

                                        <form id="appointment" method="post" >
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input class="form-control" type="hidden"  id="caretaker_id" name="caretaker_id">
                                                    <input class="form-control" type="hidden"  id="catId" name="catId">
                                                    <label for="country" class="col-form-label">Procedure</label>
                                                    <select class="form-select form-control select2" id="procedure" name="procedure" style="width:100%;">
                                                        <option value="">Select Procedure</option>
                                                        @if($procedures)
                                                            @foreach($procedures as $procedure)
                                                                <option value=" {{ $procedure->id }}" data-value="{{ $procedure->price }}"> {{ $procedure->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Price</label>
                                                    <input class="form-control" type="text"  id="price" name="price" value="" readonly placeholder="Price">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="country" class="col-form-label">Vet</label>
                                                    <select class="form-select form-control select2"  id="vet_id" name="vet_id" style="width:100%;">
                                                        <option value="">Select Vet</option>
                                                        @if($vets)
                                                            @foreach($vets as $vet)
                                                                <option value=" {{ $vet->id }}"> {{ $vet->name }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">Select Date</label>
                                                    <div class="input-group" id="datepicker2">
                                                        <input type="text" class="form-control date-picker"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                            data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"
                                                            id="appointment_date" name="appointment_date">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">Select Time</label>
                                                    <div class="input-group">
                                                        <select class="form-select form-control"  id="appointment_time" name="appointment_time" style="width:100%;">
                                                            <option value="">Select Time</option>
                                                            @if($timeslots)
                                                                @foreach($timeslots as $key=>$value)
                                                                    <option value="{{ $value['slot_start_time']}} - {{ $value['slot_end_time'] }}">{{ $value['slot_start_time']}} - {{ $value['slot_end_time'] }} </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <label for="email" class="col-form-label">Remarks</label>
                                                    <textarea class="form-control" rows="1" placeholder="Remarks" name="remarks" id="remarks"></textarea>
                                                </div>

                                                <div class="col-md-12 align-self-end mt-3 text-end">
                                                    <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Create Appoinment"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div> <!-- end modal dialog-->
                </div>
                <!-- end modal-->


            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@endsection

@push('header')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.css">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />

<style>
    .select2-selection__rendered {
    line-height: 51px !important;
}
.select2-container .select2-selection--single {
    height: 55px !important;
}
.select2-selection__arrow {
    height: 54px !important;
}
.fc-daygrid-bg-harness:has(.scheduled) {
  background:  rgb(163 246 163) !important;
  pointer-events: none !important;
}
    </style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
$(document).ready(function() {
    var calendarEl = document.getElementById('appointment_calendar');


    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        slotMinTime: '8:00:00',
        slotMaxTime: '22:00:00',
        slotMinWidth:'100',
        selectable: true,
        events: "{{ route('get-scheduled-vets')}}",
        eventContent: function( info ) {
            return {html: info.event.title};
        },
        selectOverlap: function(event) {
            console.log(event);
            if(event){
                return true;
            }
        },
        eventColor: '#ff0000',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        // dayRender: function (date, cell) {
        //     var today = new Date();
        //     if (date.getDate() === today.getDate()) {
        //         cell.css("background-color", "red");
        //     }
        // },
        select: function(start, end, jsEvent, view) {   
            startDate = start.startStr;
            endDate = getPreviousDay(start.endStr);
            betweenDates = getDatesBetween(startDate, endDate);
        
            $.each(betweenDates, function(index, value) {
                 if( $("td[data-date='"+value+"']").hasClass('custom-disabled')){
                    $("td[data-date='"+value+"']").find('.fc-highlight').removeClass('fc-highlight');
                }
            });
        },
        eventSourceSuccess: function(content, xhr) {
            var eventDates = [];
            var view = calendar.view;
            var start = view.activeStart.toISOString();
            var end = view.activeEnd.toISOString();
            var alldates = getDatesBetween(new Date(start),new Date(end));
            $.each(content, function(index1, value1) {
                eventDates.push(value1.start);
            });

            $.each(alldates, function(index, value) {
                if( $.inArray(value, eventDates) > -1 ) {
                    console.log('inarray  ' + value);
                }else{
                    console.log('not inarray  ' + value);
                    $("td[data-date='"+value+"']").addClass('custom-disabled');
                }
            });
        }
    
    });

    calendar.render();

    function IsDateHasEvent(date) {
        var allEvents = [];
        allEvents = $('#calendar').fullCalendar('clientEvents');
        var event = $.grep(allEvents, function (v) {
            return +v.start === +date;
        });
        return event.length > 0;
    }

    function convertMsToTime(milliseconds) {
        let seconds = Math.floor(milliseconds / 1000);
        let minutes = Math.floor(seconds / 60);
        let hours = Math.floor(minutes / 60);

        seconds = seconds % 60;
        minutes = minutes % 60;
        hours = hours % 24;

        return `${padTo2Digits(hours)}:${padTo2Digits(minutes)}`;
    }

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function formatDate(date) {
        var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    $( "#appointment_date" ).datepicker({
        format: 'yyyy-mm-dd',
    });
    $('#vet_id').select2({
        placeholder: 'Select Vet',
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });

    $('#search_caretaker').select2({
        placeholder: 'Search by : Customer ID, Name, Mobile Number',
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
        ajax: {
            url: '{{ route("ajax-autocomplete-caretaker-search") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name + ' ['+ item.customer_id + ']',
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#search_cat').select2({
        placeholder: 'Search by : Cat Name, Cat ID',
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
        ajax: {
            url: '{{ route("ajax-autocomplete-cat-search") }}',
            dataType: 'json',
            delay: 250,
            type: "GET",
            data: function (params, page) {
                return {
                    term: params.term, // search term
                    caretaker_id: $('#caretaker_id').val()
                };
            },

            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name + ' ['+ item.cat_id + ']',
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#procedure').select2({
        placeholder: 'Select Procedure',
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });



    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $("#search_caretaker").on("change", function () { 
        $('#cat_id,#cat_name,#date_of_birth, #fur_color,#eye_color,#place_of_origin,#cat_emirate,#cat_origin,#microchip,#catId ').val('');
        $('#pregnant-div,#neutered-with-us-div,#neutered-div,#spayed-div').css('display','none');
        $("#appointment_tab").removeAttr('data-bs-toggle');
        $("#search_cat").val('').trigger('change') ;
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('get-caretaker')}}",
            type: "POST",
            data: 'id='+ id,
            success: function( response ) {
                var returnedData = JSON.parse(response);
                if(returnedData[0]){
                    $('#customer_id').val(returnedData[0].customer_id);
                    $('#name').val(returnedData[0].name);
                    $('#address').html(returnedData[0].address);
                    $('#email').val(returnedData[0].email);
                    $('#phone').val(returnedData[0].phone_number);
                    $('#whatsapp').val(returnedData[0].whatsapp_number);
                    $('#country').val(returnedData[0].country);
                    $('#emirate').val(returnedData[0].emirate);
                    $('#work_place').val(returnedData[0].work_place);
                    $('#work_address').val(returnedData[0].work_address);
                    $('#position').val(returnedData[0].position);
                    $('#work_number').val(returnedData[0].work_contact_number);
                    $('#visa_type').val(returnedData[0].visa_status);
                    $('#passport_no').val(returnedData[0].passport_number);
                    $('#emirates_id').val(returnedData[0].emirates_id_number);
                    $('#caretaker_id').val(returnedData[0].id);
                    if(returnedData[0].is_passport_no == 1){
                        $('#PassportYes').prop('checked', true);
                        $('#passport_no').css('display','block');
                    }else{
                        $('#PassportNo').prop('checked', true);
                        $('#passport_no').css('display','none');
                    }

                    if(returnedData[0].is_emirates_id == 1){
                        $('#EmiratesYes').prop('checked', true);
                        $('#emirates_id').css('display','block');
                    }else{
                        $('#EmiratesNo').prop('checked', true);
                        $('#emirates_id').css('display','none');
                    }
                    $("#cat_tab").attr('data-bs-toggle','tab');
                }else{
                    $('#caretaker_id,#customer_id,#name, #address,#email,#phone,#whatsapp,#country,#emirate,#work_place,#work_address,#position,#work_number,#visa_type,#passport_no,#emirates_id ').val('');
                    $('#passport_no,#emirates_id').css('display','none');
                    $("#cat_tab").removeAttr('data-bs-toggle');
                }
               
            }
        });
    });

    $("#search_cat").on("change", function () { 
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('get-cat')}}",
            type: "POST",
            data: 'id='+ id,
            success: function( response ) {
                var returnedData = JSON.parse(response);
                if(returnedData[0]){
                    $('#cat_id').val(returnedData[0].cat_id);
                    $('#cat_name').val(returnedData[0].name);
                    $('#date_of_birth').val(returnedData[0].date_birth);
                    $('#fur_color').val(returnedData[0].fur_color);
                    $('#eye_color').val(returnedData[0].eye_color);
                    $('#place_of_origin').val(returnedData[0].country);
                    $('#cat_emirate').val(returnedData[0].emirate);
                    $('#cat_origin').val(returnedData[0].origin);
                    $('#microchip').val(returnedData[0].microchip_number);
                    
                    $('#catId').val(returnedData[0].id);
                    
                    $("input[name=bloodtype][value=" + returnedData[0].blood_type + "]").prop('checked', true);
                    $("input[name=GenderName][value=" + returnedData[0].gender + "]").prop('checked', true);
                    $("input[name=pregnantstatus][value=" + returnedData[0].pregnant + "]").prop('checked', true);
                    $("input[name=NeuteredStatus][value=" + returnedData[0].neutered + "]").prop('checked', true);
                    $("input[name=neuteredwith][value=" + returnedData[0].neutered_with_us + "]").prop('checked', true);
                    $("input[name=spayedstatus][value=" + returnedData[0].spayed + "]").prop('checked', true);
                    $("input[name=castratedstatus][value=" + returnedData[0].castrated + "]").prop('checked', true);
                    $("input[name=deadalive][value=" + returnedData[0].dead_alive + "]").prop('checked', true);

                    if(returnedData[0].gender == 'Female'){
                        $('#pregnant-div,#neutered-with-us-div,#neutered-div,#spayed-div').css('display','block');
                    }else{
                        $('#pregnant-div,#neutered-with-us-div,#neutered-div,#spayed-div').css('display','none');
                    }
                    $("#appointment_tab").attr('data-bs-toggle','tab');
                }else{
                    $('#cat_id,#cat_name,#date_of_birth, #fur_color,#eye_color,#place_of_origin,#cat_emirate,#cat_origin,#microchip,#catId ').val('');
                    $('#pregnant-div,#neutered-with-us-div,#neutered-div,#spayed-div').css('display','none');
                    $("#appointment_tab").removeAttr('data-bs-toggle');
                }
            }
        });
    });

    $("#caretaker_tab").on("click", function (e) { 
        $("#cat_tab,#appointment_tab").removeClass('active');
        $('#navtabs-care-taker').css('display','block');
        $('#navtabs-cat-details,#navtabs-appointment').css('display','none');
    });

    $("#cat_tab").on("click", function (e) { 
        var caretaker_id =  $('#caretaker_id').val();
        if(caretaker_id ==''){
            Swal.fire(
                '',
                'Please select the Care Taker Details!',
                'warning'
                )
        }else{
            $('#navtabs-care-taker,#navtabs-appointment').css('display','none');
            $('#navtabs-cat-details').css('display','block');
        }
    });
    $("#appointment_tab").on("click", function (e) { 
        var caretaker_id =  $('#caretaker_id').val();
        var cat_id =  $('#catId').val();
        if(cat_id =='' && caretaker_id == ''){
            Swal.fire(
                '',
                'Please select Care Taker & Cat Details!',
                'warning'
                )
        } else if(cat_id ==''){
            Swal.fire(
                '',
                'Please select Cat Details!',
                'warning'
                )
        }else if(caretaker_id == ''){
            Swal.fire(
                '',
                'Please select Care Taker Details!',
                'warning'
                )
        }else{
            $('#navtabs-appointment').css('display','block');
            $('#navtabs-care-taker,#navtabs-cat-details').css('display','none');
        }
        var date = $('#appointment_date').val();
        getSlots(date);
    });

    $('.custom-disabled').on('click', function(e) {
        e.preventDefault();
        $(this).css({'pointer-events' : 'none'});
    });
    function getSlots(appointment_date){
        $('#appointment_time  option').removeAttr("disabled");
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{ route('get-selected-slots')}}",
            type: "POST",
            data: 'id='+ appointment_date,
            
            success: function( response ) {
                var returnedData = JSON.parse(response);
                $.each(returnedData, function(index, value) {
                    $('#appointment_time  option:contains("'+value.time_appointment+'")').attr("disabled","disabled");
                });
                
            }
        });
    }

    $("#appointment_date").on("change", function () {   
       var date = $(this).val();
        getSlots(date);
    });

    $("#procedure").on("change", function () { 
        let element = document.getElementById("procedure");
        let price = element.options[element.selectedIndex].getAttribute("data-value");
        $('#price').val(price);
    });

    $("#appointment").validate({
        rules: {
            procedure: "required",
            vet_id: "required",
            appointment_date: {
                required: true
            },
            appointment_time: {
                required: true
            },
        },
        messages: {
            procedure: " Please select a procedure",
            vet_id: " Please select a vet",
            appointment_date: {
                required: " Please select appointment date"
            },
            appointment_time: {
                required: " Please select appointment time"
            }
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2')) {
                error.insertAfter(element.next('.select2-container'));
            }else{
                error.appendTo(element.parent("div"));
            }
        },
        submitHandler: function(e) { 
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#create_appoinment').html('Please Wait...');
            // $("#create_appoinment"). attr("disabled", true);
            
            var data = new FormData($('#appointment')[0]);
            $.ajax({
                url: "{{ route('save-appointment')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    // $('#create_appoinment').html('Create Appointment');
                    // $("#create_appoinment"). attr("disabled", false);
                    Swal.fire(
                        '',
                        'Appointment created successfully!',
                        'success'
                    );
                    $("#createAppointmentModal").modal('hide');
                    resetForm();
                    calendar.refetchEvents()
                }
            });
        }
    });

    function resetForm(){
        $('#appointment')[0].reset();
        $("#search_cat").val('').trigger('change') ;
        $("#procedure").val('').trigger('change') ;
        $("#vet_id").val('').trigger('change') ;
        $("#search_caretaker").val('').trigger('change') ;
        $('#caretaker_id,#customer_id,#name, #address,#email,#phone,#whatsapp,#country,#emirate,#work_place,#work_address,#position,#work_number,#visa_type,#passport_no,#emirates_id ').val('');
        $('#passport_no,#emirates_id').css('display','none');
        $("#cat_tab").removeAttr('data-bs-toggle');
        $('#cat_id,#cat_name,#date_of_birth, #fur_color,#eye_color,#place_of_origin,#cat_emirate,#cat_origin,#microchip,#catId ').val('');
        $('#pregnant-div,#neutered-with-us-div,#neutered-div,#spayed-div').css('display','none');
        $("#appointment_tab").removeAttr('data-bs-toggle');
        $('#appointment_time').val("");
        $('label.error').css('display','none');
        $('#appointment_time').removeClass('error');
    }
    $("#new_appointment").on("click", function (e) { 
        resetForm();
        $("#caretaker_tab").addClass('active');
        $("#cat_tab,#appointment_tab").removeClass('active');
        $('#navtabs-care-taker').css('display','block');
        $('#navtabs-cat-details,#navtabs-appointment').css('display','none');
    });

    
});


</script>
@endpush