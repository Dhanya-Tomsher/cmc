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

                <div class="col-md-4"  id="castrated-div">
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

                <div class="col-md-6 input4" id="behaviour-div">
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
                        <select class="form-select form-control readonly"   id="vet_id" name="vet_id" style="width:100%;">
                            <option value="">Select Vet</option>
                            @if($vets)
                                @foreach($vets as $vet)
                                    <option value="{{ $vet->id }}"> {{ $vet->name }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="address" class="col-form-label">Select Date</label>
                        <div class="input-group" id="datepicker2">
                            <input type="text" class="form-control date-picker readonly"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"
                                id="appointment_date"  name="appointment_date">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="address" class="col-form-label">Select Time</label>
                        <div class="input-group">
                            <select class="form-select form-control select2"  id="appointment_time" name="appointment_time[]" multiple="multiple" style="width:100%;">
                                
                            </select>
                        </div>
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
                        <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Create Appoinment"/>
                    </div>
                </div>
            </form>
        </div>
    </div>