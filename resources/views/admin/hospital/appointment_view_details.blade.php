<!-- Nav tabs -->
    <ul class="nav nav-tabs border-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link active"  data-bs-toggle="tab" href="#navtabs-appointmentview" role="tab">
                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                <span class="d-none d-sm-block">Appointment Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#navtabs-care-takerview" role="tab">
                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                <span class="d-none d-sm-block">Care Taker Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  data-bs-toggle="tab" href="#navtabs-cat-detailsview" role="tab">
                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                <span class="d-none d-sm-block">Cat Details</span>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content py-3 text-muted">
        <div class="tab-pane " id="navtabs-care-takerview" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <label for="example-text-input" class="col-form-label">Customer ID</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->customer_id }}" placeholder="Customer ID" readonly>
                </div>

                <div class="col-md-4">
                    <label for="Name" class="col-form-label">Name</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->caretaker_name }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea required="" class="form-control" readonly  rows="1">{{ $hosp[0]->address }}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="email" class="col-form-label">Email ID</label>
                    <input class="form-control" type="email" value="{{ $hosp[0]->email }}" readonly >
                </div>

                <div class="col-md-4">
                    <label for="phone" class="col-form-label">Phone Number</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->phone_number }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                    <input class="form-control" type="text"  value="{{ $hosp[0]->whatsapp_number }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Home Country</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->care_country }}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="country" class="col-form-label">State</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->caretaker_state }}" readonly>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Work Place</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->caretaker_work_place }}" readonly>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Work Address</label>
                    <input class="form-control" type="text" readonly value="{{ $hosp[0]->work_address }}">
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Position</label>
                    <input class="form-control" type="text" readonly value="{{ $hosp[0]->position }}">
                </div>

                <div class="col-md-4">
                    <label for="work-number" class="col-form-label">Work Contact</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->work_contact_number }}" readonly >
                </div>

                <div class="col-md-4 passport_input align-items-center"
                    id="myRadioGroup">
                    <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->is_passport_no == "1" ? 'checked' : '' }} disabled class="form-check-input" value="show">
                            <label class="form-check-label mt-1" for="PassportYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->is_passport_no == "0" ? 'checked' : '' }} disabled class="form-check-input" value="hide">
                            <label class="form-check-label mt-1" for="PassportNo">No</label>
                        </div>
                        <input class="form-control" type="text" style="{{ $hosp[0]->is_passport_no == "0" ? 'display:none;' : '' }}" value="{{ $hosp[0]->passport_number }}" readonly>
                    </div>
                </div>


                <div class="col-md-4 passport_input align-items-center" id="input3">
                    <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->is_emirates_id == "1" ? 'checked' : '' }} disabled class="form-check-input" value="show">
                            <label class="form-check-label mt-1" for="EmiratesYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->is_emirates_id == "0" ? 'checked' : '' }} disabled class="form-check-input" value="hide">
                            <label class="form-check-label mt-1" for="EmiratesNo">No</label>
                        </div>
                        <input class="form-control" type="text" value="{{ $hosp[0]->emirates_id_number }}" style=" {{ $hosp[0]->is_emirates_id == "0" ? 'display:none;' : '' }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Visa Status</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->visa_status }}" readonly>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="navtabs-cat-detailsview" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <label for="example-text-input" class="col-form-label">Cat ID</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->cat_id }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="Name" class="col-form-label">Name</label>
                    <input class="form-control" type="text" readonly value="{{ $hosp[0]->cat_name }}">
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">Date of Birth</label>
                    <input class="form-control" type="text" readonly value="{{ $hosp[0]->date_birth }}">
                </div>

                <div class="col-md-4">
                    <label for="emirates-id" class="col-form-label d-block">Gender</label>
                    <div class=" h-50 align-items-center border-bottom-1">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->gender == "Male" ? 'checked' : '' }}  disabled  value="Male"  class="form-check-input" value="hide">
                            <label class="form-check-label mt-1" for="GenderMale">Male</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->gender == "Female" ? 'checked' : '' }}  disabled  value="Female" class="form-check-input" value="show">
                            <label class="form-check-label mt-1"  for="GenderFemale">Female</label>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 input4 {{ $hosp[0]->gender == "Male" ?  "hide" : '' }}" id="pregnant-div">
                    <label for="emirates-id" class="col-form-label d-block">Pregnant /  Not</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->pregnant == "1" ? 'checked' : '' }} value="1"  disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="PregnantYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->pregnant == "0" ? 'checked' : '' }} value="0"  disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="PregnantNo">No</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->pregnant == "2" ? 'checked' : '' }} value="2"  disabled class="form-check-input">
                            <label class="form-check-label mt-1"  for="PregnantUnknown">Unknown</label>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <label for="emirates-id" class="col-form-label d-block">Blood Type</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->blood_type == "a" ? 'checked' : '' }} value="a" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="bloodA">A</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->blood_type == "b" ? 'checked' : '' }} value="b" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="bloodB">B</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->blood_type == "ab" ? 'checked' : '' }} value="ab" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="bloodAB">AB</label>
                        </div>

                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->blood_type == "mic" ? 'checked' : '' }} value="mic" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="bloodMic">mic</label>
                        </div>

                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->blood_type == "unknown" ? 'checked' : '' }} value="unknown" disabled class="form-check-input" >
                            <label class="form-check-label mt-1" for="bloodUnknown">Unknown</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 input4" >
                    <label for="emirates-id" class="col-form-label d-block">Virus</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="virusYes" value="1" name="virusstatus" {{ $hosp[0]->virus == "1" ? 'checked' : '' }} disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="virusYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="virusNo" value="0" name="virusstatus" {{ $hosp[0]->virus == "0" ? 'checked' : '' }} disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="virusNo">No</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="virusUnknown" value="2" {{ $hosp[0]->virus == "2" ? 'checked' : '' }} disabled name="virusstatus" class="form-check-input">
                            <label class="form-check-label mt-1" for="virusUnknown">Unknown</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 input4" id="neutered-div">
                    <label for="emirates-id" class="col-form-label d-block">Neutered</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->neutered == "1" ? 'checked' : '' }} value="1" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="NeuteredYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->neutered == "0" ? 'checked' : '' }} value="0"  disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="NeuteredNo">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 input4"  id="neutered-with-us-div">
                    <label for="emirates-id" class="col-form-label d-block">Neutered  with Us</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio"  {{ $hosp[0]->neutered_with_us == "1" ? 'checked' : '' }} value="1" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="NeuteredWithYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->neutered_with_us == "0" ? 'checked' : '' }} value="0" disabled class="form-check-input">
                            <label class="form-check-label mt-1"  for="NeuteredWithNo">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 input4 {{ $hosp[0]->gender == "Male" ?  "hide" : '' }}" id="spayed-div">
                    <label for="emirates-id"
                        class="col-form-label d-block">Spayed</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->spayed == "1" ? 'checked' : '' }} value="1" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="SpayedYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->spayed == "0" ? 'checked' : '' }} value="0" disabled class="form-check-input" >
                            <label class="form-check-label mt-1" for="SpayedNo">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 {{ $hosp[0]->gender == "Female" ?  "hide" : '' }}"  id="castrated-div">
                    <label for="emirates-id"
                        class="col-form-label d-block">Castrated</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->castrated == "1" ? 'checked' : '' }} value="1" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="CastratedYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->castrated == "0" ? 'checked' : '' }} value="0" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="CastratedNo">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="FurColor" class="col-form-label">Fur / Color</label>
                    <input type="text" class="form-control" readonly value="{{  $hosp[0]->fur_color }}" rows="1"/>
                </div>

                <div class="col-md-4">
                    <label for="EyeColor" class="col-form-label">Eye Color</label>
                    <input type="text" class="form-control" readonly  value="{{ $hosp[0]->eye_color }}" rows="1"/>
                </div>

                <div class="col-md-4" id="behaviour-div">
                    <label for="emirates-id" class="col-form-label d-block">Behaviour</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="behaviourGreen" value="1" {{ $hosp[0]->behaviour == "1" ? 'checked' : '' }} disabled name="behaviour" class="form-check-input" >
                            <label class="form-check-label mt-1" for="behaviourGreen">Green</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="behaviourOrange" value="2" {{ $hosp[0]->behaviour == "2" ? 'checked' : '' }}  disabled name="behaviour" class="form-check-input">
                            <label class="form-check-label mt-1" for="behaviourOrange">Orange</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" id="behaviourRed" value="3" {{ $hosp[0]->behaviour == "3" ? 'checked' : '' }}  disabled name="behaviour" class="form-check-input" >
                            <label class="form-check-label mt-1" for="behaviourRed">Red</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Place of Origin</label>
                    <input type="text" class="form-control" value="{{ $hosp[0]->cat_country }}"readonly  rows="1"/>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">State</label>
                    <input type="text" class="form-control" value="{{ $hosp[0]->cat_state }}" readonly  rows="1"/>
                </div>

                

                <div class="col-md-4">
                    <label for="phone" class="col-form-label">Microchip Number</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->microchip_number }}" readonly >
                </div>
              

                <div class="col-md-4 align-self-end">
                    <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                    <div class=" align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->dead_alive == "1" ? 'checked' : '' }} value="1" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="Alive">Alive</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hosp[0]->dead_alive == "0" ? 'checked' : '' }} value="0" disabled class="form-check-input">
                            <label class="form-check-label mt-1" for="Dead">Dead </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <label for="email" class="col-form-label">Origin / History</label>
                    <textarea  class="form-control" rows="4" readonly >{{ $hosp[0]->origin }} </textarea>
                </div>

            </div>
        </div>
        <div class="tab-pane active" id="navtabs-appointmentview" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <label for="country" class="col-form-label">Procedure</label>
                    <input type="text" class="form-control" value="{{ $hosp[0]->procedure_name }}" readonly rows="1"/>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Price</label>
                    <input class="form-control" type="text" value="{{ $hosp[0]->price }}" readonly placeholder="Price">
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Vet</label>
                    <input type="text" class="form-control"  value="{{ $hosp[0]->vet_name }}"  readonly rows="1"/>
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">Appointment Date</label>
                    <input type="text" class="form-control" value="{{ $hosp[0]->date_appointment }}"  readonly rows="1"/>
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">Appointment Time</label>
                    <input type="text" class="form-control" value="{{ $hosp[0]->time_appointment }}" readonly rows="1"/>
                </div>


                <div class="col-md-4">
                    <label for="email" class="col-form-label">Remarks</label>
                    <textarea class="form-control" rows="1" placeholder="Remarks" >{{ $hosp[0]->reason }}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="payment" class="col-form-label">Payment Type</label>
                    <input type="text" class="form-control" value="{{ ($hosp[0]->payment_type == 'pos_cash') ? 'POS or Cash' : 'Online'  }}" readonly rows="1"/>
                </div>
            </div>
        </div>
    </div>