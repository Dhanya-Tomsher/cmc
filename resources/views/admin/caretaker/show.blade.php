@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Caretaker Details'])
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
                                <li class="breadcrumb-item active"><a href="#">Caretaker
                                        Details</a></li>
                            </ol>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ URL::previous() }}" class="btn btn_back waves-effect waves-light"> <i
                                class="uil-angle-left-b"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-preview">
                                                @if($caretaker[0]->image_url == NULL)
                                                    <div id="imagePreview" style="background-image: url('{{ asset('assets/images/user_img.png') }}');">
                                                    </div>
                                                @else
                                                    <div id="imagePreview" style="background-image: url('{{  asset($caretaker[0]->image_url) }}');">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="example-text-input" class="col-form-label">Customer ID</label>
                                        <input class="form-control" name="customer_id" readonly type="text" value="{{ $caretaker[0]->customer_id }}" id="example-text-input">
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" name="name" readonly type="text" placeholder="Enter Name" id="Name" value="{{ $caretaker[0]->name }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea required="" name="address" readonly class="form-control" placeholder="Enter address" rows="2">{{ $caretaker[0]->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input class="form-control" readonly name="email" type="email" placeholder="Enter Email ID" id="Email" value="{{ $caretaker[0]->email }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input class="form-control" readonly name="phone_number" type="text" placeholder="Enter Phone Number" id="phone" value="{{ $caretaker[0]->phone_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input class="form-control" readonly name="whatsapp_number" type="text"  placeholder="Enter Whatsapp Number" id="whatsapp" value="{{ $caretaker[0]->whatsapp_number }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <input type="text" class="form-control" value="{{ $caretaker[0]->care_country }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <input type="text" class="form-control" value="{{ $caretaker[0]->emirate }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Place</label>
                                        <input class="form-control" readonly name="work_place" type="text" placeholder="Enter Work Place" value="{{ $caretaker[0]->work_place }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Address</label>
                                        <input class="form-control" readonly name="work_address" type="text" placeholder="Enter Work Address" value="{{ $caretaker[0]->work_address }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Position</label>
                                        <input class="form-control" readonly name="position" type="text" placeholder="Enter Position" value="{{ $caretaker[0]->position }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Work Contact Number</label>
                                        <input class="form-control" readonly name="work_contact_number" type="text"  placeholder="Enter Work Contact Number" id="work-number" value="{{ $caretaker[0]->work_contact_number }}">
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                        <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportYes" name="is_passport_no" disabled
                                                    class="form-check-input" value="show" {{ $caretaker[0]->is_passport_no == "1" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="PassportYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportNo" name="is_passport_no" disabled
                                                    class="form-check-input" value="hide" {{ $caretaker[0]->is_passport_no == "0" ? 'checked' : '' }} >
                                                <label class="form-check-label" for="PassportNo">No</label>
                                            </div>
                                            <input class="form-control" name="passport_number" type="text"
                                                placeholder="Enter Passport No" readonly style=" {{ $caretaker[0]->is_passport_no == "0" ? 'display:none;' : '' }}"
                                                value="{{ $caretaker[0]->passport_number }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4 passport_input align-items-center" id="input3">
                                        <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesYes" name="is_emirates_id" disabled
                                                    class="form-check-input" value="show" {{ $caretaker[0]->is_emirates_id == "1" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="EmiratesYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline"> 
                                                <input type="radio" id="EmiratesNo" name="is_emirates_id" disabled
                                                    class="form-check-input" value="hide" {{ $caretaker[0]->is_emirates_id == "0" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="EmiratesNo">No</label>
                                            </div>
                                            <input class="form-control" name="emirates_id_number" type="text"
                                                placeholder="Enter Emirates ID"  readonly style=" {{ $caretaker[0]->is_emirates_id == "0" ? 'display:none;' : '' }}"
                                                value="{{ $caretaker[0]->emirates_id_number }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Visa Status</label>
                                        <input class="form-control" name="position" readonly type="text" placeholder="Enter Position" value="{{ $caretaker[0]->visa_status }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Status</label>
                                        <input class="form-control" type="text" value="{{ ucfirst($caretaker[0]->status) }}" readonly id="microchip_number">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="emirates-id" class="col-form-label d-block">BlackList Status</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="blacklistYes" disabled {{ $caretaker[0]->is_blacklist == "1" ? 'checked' : '' }}  name="is_blacklist" class="form-check-input"  value="1">
                                                <label class="form-check-label" for="blacklistYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline" >
                                                <input type="radio" id="blacklistNo" disabled name="is_blacklist" {{ $caretaker[0]->is_blacklist == "0" ? 'checked' : '' }} class="form-check-input" value="0" >
                                                <label class="form-check-label" for="blacklistNo">No</label>
                                            </div>

                                            <input class="form-control" type="text" name="blacklist_reason" style="{{ $caretaker[0]->is_blacklist == "0" ? 'display:none;' : '' }}" value="{{ $caretaker[0]->blacklist_reason }}" placeholder="Enter reason for blacklist" id="blacklistReason" >
                                        
                                        </div>
                                    </div>
                                </div>

                            
                        </div>
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container-fluid -->
    </div>
@endsection
