@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Cat Details'])
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
                            <li class="breadcrumb-item active">Cat Deatails</li>
                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('caretaker.view', $cat[0]->caretaker_id) }}" class="btn btn_back waves-effect waves-light mt-3"> <i class="uil-angle-left-b"></i> Back</a>
                    <div class="btn_group">
                        <!-- <a href="hospital_appointments.html" class="btn btn_back waves-effect waves-light me-2"> Create
                            Hospital Appointments </a>
                        <a href="hotel_appointments.html" class="btn btn_back waves-effect waves-light" id="sa-warning">
                            Create Hotel Appointments </a> -->
                        <a href="{{ route('cat.journal', $cat[0]->id) }}" class="btn btn_back waves-effect waves-light" id="sa-warning"> Journal </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
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
                                                @if($cat[0]->image_url == NULL)
                                                    <div id="imagePreview" style="background-image: url('{{ asset('assets/images/cat_plc.jpg') }}');">
                                                    </div>
                                                @else
                                                    <div id="imagePreview" style="background-image: url('{{ asset($cat[0]->image_url) }}');">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="col-form-label">Cat ID</label>
                                        <input class="form-control" type="text"  value="{{ $cat[0]->cat_id }}"  readonly id="example-text-input">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" value="{{ $cat[0]->name }}" id="Name" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="address" class="col-form-label">Date of Birth</label>
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" class="form-control" value="{{ $cat[0]->date_birth }}" readonly>
                                        </div>
                                        <span>{{ Helper::getAgeFromDate($cat[0]->date_birth) }}</span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emirates-id" class="col-form-label d-block">Blood Type</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="BloodA" disabled {{ $cat[0]->blood_type == "a" ? 'checked' : '' }} value="a" name="blood_type" class="form-check-input">
                                                <label class="form-check-label" for="BloodA">A</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="BloodB" disabled {{ $cat[0]->blood_type == "b" ? 'checked' : '' }} value="b" name="blood_type" class="form-check-input">
                                                <label class="form-check-label" for="BloodB">B</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="BloodAB" disabled {{ $cat[0]->blood_type == "ab" ? 'checked' : '' }} value="ab" name="blood_type" class="form-check-input">
                                                <label class="form-check-label" for="BloodAB">AB</label>
                                            </div>

                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="BloodMic" disabled {{ $cat[0]->blood_type == "mic" ? 'checked' : '' }} value="mic" name="blood_type" class="form-check-input">
                                                <label class="form-check-label" for="BloodMic">mic</label>
                                            </div>

                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="BloodUnknown" disabled {{ $cat[0]->blood_type == "unknown" ? 'checked' : '' }} value="unknown" name="blood_type" class="form-check-input">
                                                <label class="form-check-label" for="BloodUnknown">Default</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4" >
                                        <label for="emirates-id" class="col-form-label d-block">Virus</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="virusYes" value="1" name="virusstatus" disabled {{ $cat[0]->virus == "1" ? 'checked' : '' }} class="form-check-input">
                                                <label class="form-check-label" for="virusYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="virusNo" value="0" name="virusstatus" disabled {{ $cat[0]->virus == "0" ? 'checked' : '' }} class="form-check-input">
                                                <label class="form-check-label" for="virusNo">No</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="virusUnknown" value="2" disabled {{ $cat[0]->virus == "2" ? 'checked' : '' }} name="virusstatus" class="form-check-input">
                                                <label class="form-check-label" for="virusUnknown">Unknown</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emirates-id" class="col-form-label d-block">Gender</label>
                                        <div class="d-flex h-50 align-items-center border-bottom-1">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="GenderMale" disabled {{ $cat[0]->gender == "Male" ? 'checked' : '' }}  value="Male" name="gender" class="form-check-input" value="hide" >
                                                <label class="form-check-label" for="GenderMale">Male</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="GenderFemale" disabled {{ $cat[0]->gender == "Female" ? 'checked' : '' }} value="Female" name="gender" class="form-check-input" value="show">
                                                <label class="form-check-label" for="GenderFemale">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4" >
                                        <label for="emirates-id" class="col-form-label d-block">Neutered</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="NeuteredYes" disabled value="1" {{ $cat[0]->neutered == "1" ? 'checked' : '' }}  name="neutered" class="form-check-input">
                                                <label class="form-check-label" for="NeuteredYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="NeuteredNo" disabled value="0" {{ $cat[0]->neutered == "0" ? 'checked' : '' }} name="neutered" class="form-check-input">
                                                <label class="form-check-label" for="NeuteredNo">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4" >
                                        <label for="emirates-id" class="col-form-label d-block">Neutered with Us</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="NeuteredWithYes" disabled value="1" {{ $cat[0]->neutered_with_us == "1" ? 'checked' : '' }}  name="neutered_with_us" class="form-check-input">
                                                <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="NeuteredWithNo" disabled value="0" {{ $cat[0]->neutered_with_us == "0" ? 'checked' : '' }}   name="neutered_with_us" class="form-check-input">
                                                <label class="form-check-label" for="NeuteredWithNo">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4 {{ $cat[0]->gender == "Male" ?  "hide" : '' }}"  id="spayed-div">
                                        <label for="emirates-id" class="col-form-label d-block">Spayed</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="SpayedYes" disabled value="1" {{ $cat[0]->spayed == "1" ? 'checked' : '' }} name="spayed" class="form-check-input">
                                                <label class="form-check-label" for="SpayedYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="SpayedNo" disabled  value="0" {{ $cat[0]->spayed == "0" ? 'checked' : '' }} name="spayed" class="form-check-input">
                                                <label class="form-check-label" for="SpayedNo">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4 {{ $cat[0]->gender == "Female" ?  "hide" : '' }}"  id="castrated-div">
                                        <label for="emirates-id" class="col-form-label d-block">Castrated</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="CastratedYes" disabled value="1" {{ $cat[0]->castrated == "1" ? 'checked' : '' }}  name="castrated" class="form-check-input">
                                                <label class="form-check-label" for="CastratedYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="CastratedNo" disabled value="0" {{ $cat[0]->castrated == "0" ? 'checked' : '' }}  name="castrated" class="form-check-input">
                                                <label class="form-check-label" for="CastratedNo">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 input4 {{ $cat[0]->gender == "Male" ?  "hide" : '' }}"   id="pregnant-div">
                                        <label for="emirates-id" class="col-form-label d-block">Pregnant /  Not</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PregnantYes" disabled {{ $cat[0]->pregnant == "1" ? 'checked' : '' }} value="1" name="pregnantstatus" class="form-check-input">
                                                <label class="form-check-label" for="PregnantYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PregnantNo" disabled {{ $cat[0]->pregnant == "0" ? 'checked' : '' }} value="0" name="pregnantstatus" class="form-check-input">
                                                <label class="form-check-label" for="PregnantNo">No</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PregnantUnknown" disabled {{ $cat[0]->pregnant == "2" ? 'checked' : '' }} value="2" name="pregnantstatus" class="form-check-input">
                                                <label class="form-check-label" for="PregnantUnknown">Unknown</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="FurColor" class="col-form-label">Fur / Color</label>
                                        <input type="text" value="{{  $cat[0]->fur_color }}" readonly name="fur_color" class="form-control" id="FurColor"  placeholder="Enter Fur / Color">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="EyeColor" class="col-form-label">Eye Color</label>
                                        <input type="text" value="{{ $cat[0]->eye_color }}" readonly name="eye_color" class="form-control" id="EyeColor" placeholder="Enter Eye Color">
                                    </div>

                                    <div class="col-md-6 input4" id="behaviour-div">
                                            <label for="emirates-id" class="col-form-label d-block">Behaviour</label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourGreen" value="1" disabled {{ $cat[0]->behaviour == "1" ? 'checked' : '' }}  name="behaviour" class="form-check-input" >
                                                    <label class="form-check-label" for="behaviourGreen">Green</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourOrange" value="2" disabled {{ $cat[0]->behaviour == "2" ? 'checked' : '' }}  name="behaviour" class="form-check-input">
                                                    <label class="form-check-label" for="behaviourOrange">Orange</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourRed" value="3" disabled {{ $cat[0]->behaviour == "3" ? 'checked' : '' }}  name="behaviour" class="form-check-input" >
                                                    <label class="form-check-label" for="behaviourRed">Red</label>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-6">
                                        <label for="country" class="col-form-label">Place of Origin</label>
                                        <input type="text" class="form-control" value="{{ $cat[0]->cat_country }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <input type="text" class="form-control" value="{{ $cat[0]->emirate }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="col-form-label">Origin / History</label>
                                        <input type="text" value="{{ $cat[0]->origin }}" name="origin" readonly class="form-control" placeholder="Enter Origin / History">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone" class="col-form-label">Microchip Number</label>
                                        <input class="form-control" type="text" value="{{ $cat[0]->microchip_number }}" readonly  id="microchip_number">
                                    </div>

                                    <div class="col-md-6 align-self-end">
                                        <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="Alive" disabled value="1" {{ $cat[0]->dead_alive == "1" ? 'checked' : '' }} name="dead_alive" class="form-check-input" checked>
                                                <label class="form-check-label" for="Alive">Alive</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="Dead" disabled value="0" {{ $cat[0]->dead_alive == "0" ? 'checked' : '' }} name="dead_alive"  class="form-check-input">
                                                <label class="form-check-label" for="Dead">Dead </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <label for="phone" class="col-form-label">Status</label>
                                        <input class="form-control" type="text" value="{{ ucfirst($cat[0]->status) }}" readonly id="microchip_number">
                                    </div> -->

                                </div>

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