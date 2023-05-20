@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hotel Bookings'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Manage Hotel Bookings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Hotel Bookings</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-60">
                        <form>
                            <div class="hstack gap-2">
                                <input class="form-control me-auto border-0" type="text" id="search" placeholder="Search with Room Number, Caretaker and Cat ">
                                <button type="button" class="btn btn_back waves-effect waves-light w-md" id="bookingSearch" onclick="getBookings()">Search</button>
                                <button type="button" class="btn btn_back waves-effect waves-light w-md" id="bookingReset">Reset</button>
                            </div>
                        </form>
                    </div>

                    <div class="btn_group">
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                            <input type="text" class="form-control text-start" placeholder="From" name="From" id="from_date">
                            <input type="text" class="form-control text-start" placeholder="To" name="To" id="to_date">
                            <button type="button" class="btn btn-primary" id="dateFilter" onclick="getBookings()"><i  class="fa fa-search"></i></button>
                            <button type="button" class="btn btn-primary" id="resetDateFilter" ><i  class="fa fa-sync"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0" id="hotelBookings">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Room Number</th>
                                        <th>Caretaker Name</th>
                                        <!-- <th>Caretaker ID</th> -->
                                        <th>Cat Name</th>
                                        <!-- <th>Cat ID</th> -->
                                        <th>Created At</th>
                                        <th class="text-center w-10">Payment Confirmation</th>
                                        <th class="text-center w-10">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="bookingDetails">
                                    <tr>
                                        <td colspan="10" class="text-center"> No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

         <!-- Add New Event MODAL --> 
         <div class="modal fade bs-example-modal-xl" id="appointmentDetails" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Booking Details </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="appointment_details">
                        
                    </div>
                </div><!-- /.modal-content -->
            </div> <!-- end modal dialog-->
        </div>
        <!-- end modal-->

        <!-- Add New Event MODAL --> 
        <div class="modal fade bs-example-modal-xl" id="createAppointmentModal" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Hotel Appointments </h5>
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
                                                        <label class="form-check-label" for="bloodUnknown">Default</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 input4" >
                                                <label for="emirates-id" class="col-form-label d-block">Virus</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="virusYes" value="1" name="virusstatus" disabled class="form-check-input">
                                                        <label class="form-check-label" for="virusYes">Yes</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="virusNo" value="0" name="virusstatus" disabled class="form-check-input">
                                                        <label class="form-check-label" for="virusNo">No</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="virusUnknown" value="2" disabled name="virusstatus" class="form-check-input">
                                                        <label class="form-check-label" for="virusUnknown">Unknown</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 input4" id="neutered-div">
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

                                            <div class="col-md-4 input4"  id="neutered-with-us-div">
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

                                            <div class="col-md-4" id="castrated-div">
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

                                            <div class="col-md-4" id="behaviour-div">
                                                <label for="emirates-id" class="col-form-label d-block">Behaviour</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="behaviourGreen" value="1" disabled name="behaviour" class="form-check-input" >
                                                        <label class="form-check-label" for="behaviourGreen">Green</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="behaviourOrange" value="2" disabled name="behaviour" class="form-check-input">
                                                        <label class="form-check-label" for="behaviourOrange">Orange</label>
                                                    </div>
                                                    <div class="custom-radio form-check form-check-inline">
                                                        <input type="radio" id="behaviourRed" value="3" disabled name="behaviour" class="form-check-input" >
                                                        <label class="form-check-label" for="behaviourRed">Red</label>
                                                    </div>
                                                </div>
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
                                                <label for="email" class="col-form-label">Origin / History</label>
                                                <input type="text" class="form-control" rows="1" id="cat_origin" name="cat_origin" readonly placeholder="Origin / History"/>
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
                                                    <label for="address" class="col-form-label">From Date</label>
                                                    <div class="input-group" id="datepicker2">
                                                        <input type="text" class="form-control date-picker "  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                            data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"
                                                            id="start_date"  name="start_date">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address" class="col-form-label">To Date</label>
                                                    <div class="input-group" id="datepicker2">
                                                        <input type="text" class="form-control date-picker "  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                            data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"
                                                            id="end_date"  name="end_date">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">

                                                    <input class="form-control" type="hidden"  id="appointment_id" name="appointment_id">
                                                    <input class="form-control" type="hidden"  id="caretaker_id" name="caretaker_id">
                                                    <input class="form-control" type="hidden"  id="catId" name="catId">
                                                    <input class="form-control" type="hidden"  id="editcatId" name="editcatId">
                                                    <input type="hidden" name="edit_from" id="edit_from" value="">
                                                    <input type="hidden" name="edit_to" id="edit_to" value="">
                                                    <input type="hidden" name="edit_room_id" id="edit_room_id" value="">

                                                    <label for="country" class="col-form-label">Rooms</label>
                                                    <select class="form-select form-control select2" id="rooms" name="rooms" style="width:100%;">
                                                        <option value="">Select Room</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label">Amount</label>
                                                    <input class="form-control" type="text"  id="price" name="price" value="" readonly placeholder="Price">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="email" class="col-form-label">Remarks</label>
                                                    <textarea class="form-control" rows="1" placeholder="Remarks" name="remarks" id="remarks"></textarea>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="payment" class="col-form-label">Payment Type</label>
                                                    <select class="form-select form-control select2" id="payment_type" name="payment_type" style="width:100%;">
                                                        <option value="online">Online</option>
                                                        <option value="pos_cash">POS or Cash</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-12 align-self-end mt-3 text-end">
                                                    <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Update Booking"/>
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

    </div> <!-- container-fluid -->
</div>
@endsection
@push('header')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    getBookings(); 

    $('#search_caretaker').select2({
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
    });
    $('#search_cat').select2({
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
    });

    function getBookings(){
        var search = $('#search').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        $.ajax({
            url: "{{ route('booking.list')}}",
            type: "POST",
            data: { 
                search:search,
                from_date:from_date,
                to_date:to_date
            },
            success: function( response ) {
                // $('#hotelBookings').DataTable().clear();
                // $('#hotelBookings').DataTable().destroy();
                $('#bookingDetails').html(response);
                $('#hotelBookings').DataTable();  
            }
        });
    }
    function deleteBooking(id){
        var el = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this booking details?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = [];
                $.ajax({
                    url: "{{ route('booking.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
                        console.log('#appid_'+id);
                        $('#appid_'+id).css('background','#f9a8a8');
                        $('#appid_'+id).fadeOut(900,function(){
                            $(this).remove();
                        });
                        Swal.fire(
                            'Deleted successfully',
                            '',
                            'success'
                        );
                    }
                });
            } 
            
        })
    }
   
    $("#bookingReset").on("click", function (e) { 
        $('#search').val('');
        getBookings(); 
    });
    $("#resetDateFilter").on("click", function (e) { 
        $('#from_date,#to_date' ).datepicker( 'setDate', '' ).datepicker('fill');
        getBookings(); 
    });

    function viewBooking(app_id){
        $.ajax({
            url: "{{ route('booking.view')}}",
            type: "POST",
            data: { 
                id:app_id
            },
            success: function( response ) {
                $('#appointment_details').html(response);
                $('#appointmentDetails').modal('show');  
            }
        });
    }

    $( "#start_date, #end_date" ).datepicker({
        format: 'yyyy-mm-dd',
    });

    jQuery.validator.addMethod("greaterThan", function(value, element, params) {

    if (!/Invalid|NaN/.test(new Date(value))) {
        return new Date(value) >= new Date($(params).val());
    }

    return isNaN(value) && isNaN($(params).val()) 
        || (Number(value) >= Number($(params).val())); 
    },'Must be greater than from date.');


    $('#rooms').select2({
        placeholder: 'Select Room',
        dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $("#search_caretaker").on("change", function () { 
        $('#cat_id,#cat_name,#date_of_birth, #fur_color,#eye_color,#place_of_origin,#cat_emirate,#cat_origin,#microchip,#catId ').val('');
        $('#pregnant-div,#spayed-div').css('display','none');
        $('#castrated-div').css('display','block');
        $("#appointment_tab").removeAttr('data-bs-toggle');
        $("#search_cat").val('').trigger('change') ;
        var id = $(this).val();
       
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
                getCatData(id);
            }
        });
    });

    function getCatData(cid){
        var editCat = $('#editcatId').val();
        $.ajax({
            url: "{{ route('get-caretaker-cats')}}",
            type: "POST",
            data: 'cid='+ cid,
            success: function( response ) {
                var returnedData = JSON.parse(response);
                var cats_html = '';

                $.each(returnedData, function(index, value) {
                cats_html += '<option value="'+value.id+'" >'+value.name + ' ['+ value.cat_id + ']'+'</option>';
                });  

                $('#search_cat').html(cats_html);
                $("#search_cat").val(editCat).trigger('change');
            }
        });
    }

    $("#search_cat").on("change", function () { 
        var id = $(this).val();
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
                    $("input[name=behaviour][value=" + returnedData[0].behaviour + "]").prop('checked', true);
                    $("input[name=virusstatus][value=" + returnedData[0].virus + "]").prop('checked', true);

                    if(returnedData[0].gender == 'Female'){
                        $('#pregnant-div,#spayed-div').css('display','block');
                        $('#castrated-div').css('display','none');
                    }else{
                        $('#pregnant-div,#spayed-div').css('display','none');
                        $('#castrated-div').css('display','block');
                    }
                    $("#appointment_tab").attr('data-bs-toggle','tab');
                }else{
                    $('#cat_id,#cat_name,#date_of_birth, #fur_color,#eye_color,#place_of_origin,#cat_emirate,#cat_origin,#microchip,#catId ').val('');
                    $('#pregnant-div,#spayed-div').css('display','none');
                    $('#castrated-div').css('display','block');
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
                'Please select the Caretaker Details!',
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
                'Please select Caretaker & Cat Details!',
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
                'Please select Caretaker Details!',
                'warning'
                )
        }else{
            $('#navtabs-appointment').css('display','block');
            $('#navtabs-care-taker,#navtabs-cat-details').css('display','none');
        }
    });

    function getRooms(startDate,endDate,room_number=''){
        var editRoom = $('#edit_room_id').val();
        var editStart = $('#edit_from').val();
        var editEnd = $('#edit_to').val();
        $.ajax({
            url: "{{ route('get-available-edit-rooms')}}",
            type: "POST",
            data:  { 
                    startDate: startDate,
                    endDate :endDate,
                    editStart:editStart,
                    editEnd:editEnd,
                    editRoom:editRoom
            },
            success: function( response ) {
                var html='';
                var returnedData = JSON.parse(response);
                    html += '<option value=""> Select Room </option>';
                $.each(returnedData, function(index, value) {
                    html += '<option value="'+value.id+'" data-value="'+value.amount+'"> '+value.room_number+' </option>';
                });  
                
                $('#rooms').html(html).trigger('change');
                $("#rooms").val(room_number).trigger('change');
            }
        });
    }

    $("#rooms").on("change", function () { 
        var sele = $('select[name=rooms] option').filter(':selected').attr('data-value');
        $('#price').val(sele);
    });

    $("#start_date, #end_date").on("change", function () { 
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var room_id = $('#rooms').val();

        var editRoom = $('#edit_room_id').val();
        var editStart = $('#edit_from').val();
        var editEnd = $('#edit_to').val();

        if(editStart == startDate && editEnd == endDate && editRoom == room_id){
            if($('#end_date').valid()){
                    getRooms(startDate,endDate,editRoom);
            }else{
                    getRooms(startDate,'',editRoom);
            }
        }else{
            if($('#end_date').valid()){
                    getRooms(startDate,endDate);
            }else{
                    getRooms(startDate,'');
            }
        }  
    });

    $("#appointment").validate({
        rules: {
            rooms: "required",
            vet_id: "required",
            start_date: {
                required: true
            },
            end_date: {
                required: true,
                greaterThan:"#start_date"
            }
        },
        messages: {
            rooms: " Please select a room",
            vet_id: " Please select a vet",
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2')) {
                error.insertAfter(element.next('.select2-container'));
            }else{
                error.appendTo(element.parent("div"));
            }
        },
        submitHandler: function(e) { 
            
            // $('#create_appoinment').html('Please Wait...');
            // $("#create_appoinment"). attr("disabled", true);
            
            var data = new FormData($('#appointment')[0]);
            $.ajax({
                url: "{{ route('update-hotel-booking')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    // $('#create_appoinment').html('Create Appointment');
                    // $("#create_appoinment"). attr("disabled", false);
                    Swal.fire(
                        '',
                        'Booking updated successfully!',
                        'success'
                    );
                    $("#createAppointmentModal").modal('hide');
                    getBookings(); 
                }
            });
        }
    });

    function editBooking(app_id){
        $.ajax({
            url: "{{ route('booking.edit')}}",
            type: "POST",
            data: { 
                id:app_id
            },
            success: function( response ) {
                var result = JSON.parse(response);
                $('#start_date' ).datepicker( 'setDate', result.appointment[0].start_date ).datepicker('fill');
                $('#end_date' ).datepicker( 'setDate', result.appointment[0].end_date ).datepicker('fill');
                $("#caretaker_tab").addClass('active');
                $("#cat_tab,#appointment_tab").removeClass('active');
                $('#navtabs-care-taker').css('display','block');
                $('#navtabs-cat-details,#navtabs-appointment').css('display','none');

                var caretaker_html = '';

                $.each(result.caretakers, function(index, value) {
                   caretaker_html += '<option value="'+value.id+'">'+value.name + ' ['+ value.customer_id + ']'+'</option>';
                });  
                $('#search_caretaker').html(caretaker_html);
                $('#search_caretaker').trigger('change');
                $("#search_caretaker").val(result.appointment[0].caretaker_id).trigger('change');

                var cats_html = '';

                $.each(result.cats, function(index, value) {
                   cats_html += '<option value="'+value.id+'" >'+value.name + ' ['+ value.cat_id + ']'+'</option>';
                });  

                $('#search_cat').html(cats_html);
                $("#search_cat").val(result.appointment[0].cat_id).trigger('change');
                $('#catId').val(result.appointment[0].cat_id);
                $('#editcatId').val(result.appointment[0].cat_id);
                
                $("#rooms").val(result.appointment[0].room_number).trigger('change');
               
                $('#remarks').html(result.appointment[0].caretaker_comment);
                $('#payment_type').val(result.appointment[0].payment_type);

                $('#edit_from').val(result.appointment[0].start_date);
                $('#edit_to').val(result.appointment[0].end_date);
                $('#edit_room_id').val(result.appointment[0].room_number);

                $('#appointment_id').val(result.appointment[0].id);

                getRooms(result.appointment[0].start_date,result.appointment[0].end_date,result.appointment[0].room_number);
                $('#createAppointmentModal').modal('show');  
            }
        });
    }

    function changePaymentStatus(id,status){
        Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change this payment status?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
        }).then(function(result) {
            if (result.isConfirmed) {
                var data = []
                $.ajax({
                    url: "{{ route('hotel-payment-status')}}",
                    type: "POST",
                    data: { id:id,status:status },
                    success: function( response ) {
                        var html = '';
                      
                        if(status == 0){
                            html = '<a class="payment_not_confirmed" onclick="changePaymentStatus('+id+',1);"><i class="fas fa-times"></i></a>';
                        }else{
                            html = '<a class="payment_confirmed" onclick="changePaymentStatus('+id+',0);"><i class="fas fa-check"></i></a>';
                        }
                        console.log(html);
                        $('#payment_'+id).html(html);
                        
                        Swal.fire(
                            'Status changed successfully',
                            '',
                            'success'
                        );
                    }
                });
            } 
            
        })
    }
</script>
@endpush