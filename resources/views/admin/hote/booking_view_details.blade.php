<!-- Nav tabs -->
<ul class="nav nav-tabs border-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#navtabs-appointment-view" role="tab">
                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                <span class="d-none d-sm-block">Booking Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  data-bs-toggle="tab" href="#navtabs-care-taker-view" role="tab">
                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                <span class="d-none d-sm-block">Care Taker Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  data-bs-toggle="tab" href="#navtabs-cat-details-view" role="tab">
                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                <span class="d-none d-sm-block">Cat Details</span>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content py-3 text-muted">
        <div class="tab-pane " id="navtabs-care-taker-view" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <label for="example-text-input" class="col-form-label">Customer ID</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->customer_id }}" placeholder="Customer ID" readonly>
                </div>

                <div class="col-md-4">
                    <label for="Name" class="col-form-label">Name</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->caretaker_name }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea required="" class="form-control" readonly  rows="1">{{ $hotel[0]->address }}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="email" class="col-form-label">Email ID</label>
                    <input class="form-control" type="email" value="{{ $hotel[0]->email }}" readonly >
                </div>

                <div class="col-md-4">
                    <label for="phone" class="col-form-label">Phone Number</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->phone_number }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                    <input class="form-control" type="text"  value="{{ $hotel[0]->whatsapp_number }}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Home Country</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->care_country }}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="country" class="col-form-label">State</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->caretaker_state }}" readonly>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Work Place</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->caretaker_work_place }}" readonly>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Work Address</label>
                    <input class="form-control" type="text" readonly value="{{ $hotel[0]->work_address }}">
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Position</label>
                    <input class="form-control" type="text" readonly value="{{ $hotel[0]->position }}">
                </div>

                <div class="col-md-4">
                    <label for="work-number" class="col-form-label">Work Contact</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->work_contact_number }}" readonly >
                </div>

                <div class="col-md-4 passport_input align-items-center"
                    id="myRadioGroup">
                    <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                    <div class="d-flex align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hotel[0]->is_passport_no == "1" ? 'checked' : '' }} disabled class="form-check-input" value="show">
                            <label class="form-check-label mt-1" for="PassportYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hotel[0]->is_passport_no == "0" ? 'checked' : '' }} disabled class="form-check-input" value="hide">
                            <label class="form-check-label mt-1" for="PassportNo">No</label>
                        </div>
                        <input class="form-control" type="text" style="{{ $hotel[0]->is_passport_no == "0" ? 'display:none;' : '' }}" value="{{ $hotel[0]->passport_number }}" readonly>
                    </div>
                </div>


                <div class="col-md-4 passport_input align-items-center" id="input3">
                    <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                    <div class="d-flex align-items-center">
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hotel[0]->is_emirates_id == "1" ? 'checked' : '' }} disabled class="form-check-input" value="show">
                            <label class="form-check-label mt-1" for="EmiratesYes">Yes</label>
                        </div>
                        <div class="custom-radio form-check form-check-inline">
                            <input type="radio" {{ $hotel[0]->is_emirates_id == "0" ? 'checked' : '' }} disabled class="form-check-input" value="hide">
                            <label class="form-check-label mt-1" for="EmiratesNo">No</label>
                        </div>
                        <input class="form-control" type="text" value="{{ $hotel[0]->emirates_id_number }}" style=" {{ $hotel[0]->is_emirates_id == "0" ? 'display:none;' : '' }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Visa Status</label>
                    <input class="form-control" type="text" value="{{ $hotel[0]->visa_status }}" readonly>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="navtabs-cat-details-view" role="tabpanel">
            <div class="row">
                @if(isset($hotel[0]['cats']))
                    @foreach($hotel[0]['cats'] as $hotelCats)
                        <div class="col-md-4" id="cat_id">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">{{$hotelCats['name']}}</h4>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">Cat ID</div>
                                        <div class="col-md-6">: {{$hotelCats['cat_id']}}</div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">Date of Birth</div>
                                        <div class="col-md-6">: {{$hotelCats['date_birth']}}</div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">Gender</div>
                                        <div class="col-md-6">: {{$hotelCats['gender']}}</div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">Blood Type</div>
                                        <div class="col-md-6 uppercase">: {{$hotelCats['blood_type']}}</div>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">Microchip Number</div>
                                        <div class="col-md-6">: {{$hotelCats['microchip_number']}}</div>
                                    </div>
                                </div><!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane active" id="navtabs-appointment-view" role="tabpanel">
            <div class="row">
                <div class="col-md-4">
                    <label for="address" class="col-form-label">From Date</label>
                    <div class="input-group" id="datepicker2">
                        <input type="text" class="form-control" value="{{ $hotel[0]->start_date }}"  readonly>
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="address" class="col-form-label">To Date</label>
                    <div class="input-group" id="datepicker2">
                        <input type="text" class="form-control" value="{{ $hotel[0]->end_date }}"  readonly >
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="country" class="col-form-label">Rooms</label>
                    <input type="text" class="form-control" value="{{ $hotel[0]->room_no }}" readonly >
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Amount</label>
                    <input class="form-control" type="text"   value="{{ $hotel[0]->amount }}" readonly placeholder="Price">
                </div>

                <div class="col-md-4">
                    <label for="email" class="col-form-label">Remarks</label>
                    <textarea class="form-control" rows="1" placeholder="Remarks"  readonly >{{$hotel[0]->caretaker_comment}}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="payment" class="col-form-label">Payment Type</label>
                    <input type="text" class="form-control" value="{{ ($hotel[0]->payment_type == 'pos_cash') ? 'POS or Cash' : 'Online'  }}" readonly rows="1"/>
                </div>
            </div>
        </div>
    </div>