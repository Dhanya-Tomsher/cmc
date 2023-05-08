@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Create Cat'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Create Cat</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">Create Cat</a></li>
                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('cat.index') }}" class="btn btn_back waves-effect waves-light mt-3"> <i
                            class="uil-angle-left-b"></i> Back</a>
                    <div class="btn_group">
                        <!-- <a href="hospital_appointments.html" class="btn btn_back waves-effect waves-light me-2"> Create
                            Hospital Appointments </a>
                        <a href="hotel_appointments.html" class="btn btn_back waves-effect waves-light" id="sa-warning">
                            Create Hotel Appointments </a> -->
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
                        <form name="frm"  id="createCat" action="{{ route('cat.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body py-4">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="avatar-upload">
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('assets/images/cat_img.jpg');">
                                                        <div class="edit_button">
                                                            <!-- <a href="cat_details.html"
                                                                class="btn btn-primary waves-effect waves-light py-2 float-end">Update</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit mt-2">
                                                    <input type="file" id="imageUpload" name="image_url" accept=".png, .jpg, .jpeg">
                                                    <label for="imageUpload"> Upload Profile Image </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="col-form-label">Caretaker ID<span class="required">*</span></label>
                                            <select class="form-select form-control" name="caretaker_id"  id="caretaker_id">
                                                <option value="" >Select Caretaker</option>
                                                @foreach ($caretakers as $ct)
                                                    <option {{ old('caretaker_id') == $ct->id ? 'selected' : '' }} value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="col-form-label">Cat ID<span class="required">*</span></label>
                                            <input class="form-control" name="cat_id" placeholder="Enter Cat ID" type="text" id="cat_id" value="{{ old('cat_id') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="Name" class="col-form-label">Name<span class="required">*</span></label>
                                            <input class="form-control" name="name" type="text" placeholder="Enter Name"  value="{{ old('name') }}" id="name">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address" class="col-form-label">Date of Birth</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" name="date_birth" id="date_birth"  class="form-control"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                    data-date-container="#datepicker1" data-provide="datepicker"  data-date-autoclose="true"  value="{{ old('date_birth') }}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="emirates-id" class="col-form-label d-block">Blood Type</label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodA" value="a" name="blood_type"  class="form-check-input">
                                                    <label class="form-check-label" for="BloodA">A</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodB" value="b" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodB">B</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodAB" value="ab" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodAB">AB</label>
                                                </div>

                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodMic" value="mic" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodMic">mic</label>
                                                </div>

                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodUnknown" value="unknown" name="blood_type"  class="form-check-input" checked>
                                                    <label class="form-check-label" for="BloodUnknown">Unknown</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="emirates-id" class="col-form-label d-block">Gender<span class="required">*</span></label>
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

                                        <div class="col-md-6 input4" >
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

                                        <div class="col-md-6 input4" >
                                            <label for="emirates-id" class="col-form-label d-block">Neutered with  Us</label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredWithYes" value="1" name="neutered_with_us" class="form-check-input">
                                                    <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredWithNo" value="0"  name="neutered_with_us" class="form-check-input" checked>
                                                    <label class="form-check-label" for="NeuteredWithNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 input4" style="display: none;" id="spayed-div">
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

                                        <div class="col-md-6 input4" id="castrated-div">
                                            <label for="emirates-id" class="col-form-label d-block" >Castrated</label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="CastratedYes" value="1" name="castrated" class="form-check-input">
                                                    <label class="form-check-label" for="CastratedYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="CastratedNo" value="0" name="castrated" class="form-check-input" checked>
                                                    <label class="form-check-label" for="CastratedNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 input4" style="display: none;" id="pregnant-div">
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
                                                    <input type="radio" id="PregnantUnknown" value="2"  name="pregnantstatus" class="form-check-input" checked>
                                                    <label class="form-check-label"
                                                        for="PregnantUnknown">Unknown</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="FurColor" class="col-form-label">Fur / Color</label>
                                            <input type="text" name="fur_color" class="form-control" id="fur_color" placeholder="Enter Fur / Color">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="EyeColor" class="col-form-label">Eye Color</label>
                                            <input type="text" name="eye_color" class="form-control" id="eye_color"  placeholder="Enter Eye Color">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label">Place of Origin</label>
                                            <select class="form-select form-control" name="place_of_origin">
                                                <option value="0" selected disabled>Select</option>
                                                @foreach ($countries as $item)
                                                    <option {{ old('home_country') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label">Emirate</label>
                                            <select class="form-select form-control" name="emirate">
                                                <option value="0" selected disabled>Select</option>
                                                <option {{ old('emirate') == 'Abu Dhabi' ? 'selected' : '' }} value="Abu Dhabi">Abu Dhabi</option>
                                                <option {{ old('emirate') == 'Dubai' ? 'selected' : '' }} value="Dubai">Dubai</option>
                                                <option {{ old('emirate') == 'Sharjah' ? 'selected' : '' }} value="Sharjah">Sharjah</option>
                                                <option {{ old('emirate') == 'Ajman' ? 'selected' : '' }} value="Ajman">Ajman</option>
                                                <option {{ old('emirate') == 'Umm Al Quwain' ? 'selected' : '' }} value="Umm Al Quwain">Umm Al Quwain</option>
                                                <option {{ old('emirate') == 'Ras Al Khaimah' ? 'selected' : '' }} value="Ras Al Khaimah">Ras Al Khaimah</option>
                                                <option {{ old('emirate') == 'Fujairah' ? 'selected' : '' }} value="Fujairah">Fujairah</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label">Origin</label>
                                            <input type="text" name="origin" class="form-control" placeholder="Enter Origin">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="phone" class="col-form-label">Microchip Number</label>
                                            <input class="form-control" name="microchip_number" type="text" placeholder="Enter Microchip Number" id="microchip_number">
                                        </div>

                                        <div class="col-md-6 align-self-end">
                                            <label for="emirates-id" class="col-form-label d-block">Dead / Alive</label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="Alive" value="1" name="dead_alive" class="form-check-input" checked>
                                                    <label class="form-check-label" for="Alive">Alive</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="Dead" value="0" name="dead_alive" class="form-check-input">
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col-->

        </div> <!-- end row-->
    </div><!-- container-fluid -->
</div> 
@endsection
@push('header')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
     $( "#date_birth" ).datepicker({
        format: 'yyyy-mm-dd',
    });
    $('input[name="gender"]').on('click',function(){
        if($(this).val() == 'Female'){
            $('#pregnant-div,#spayed-div').css('display','block');
            $('#castrated-div').css('display','none');
        }else{
            $('#pregnant-div,#spayed-div').css('display','none');
            $('#castrated-div').css('display','block');
        }
    });

    $('#caretaker_id').select2({
        placeholder: 'Select Caretaker',
        // dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });

    $("#createCat").validate({
        rules: {
            name: "required",
            caretaker_id: "required",
            cat_id:{
                    required: true,
                    remote: {
                        url: "{{ route('cat.check-availability')}}",
                        type: "post"
                    }
                }
        },
        messages: {
            caretaker_id: " Please select a caretaker",
            name: " Please enter a name",
            cat_id:{
                    required: "Please enter Cat ID.",
                    remote: "This Cat ID already exists."
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
            var data = new FormData($('#createCat')[0]);
            $.ajax({
                url: "{{ route('cat.store')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        'Cat details added successfully!',
                        'success'
                    );
                    $("#createCat")[0].reset();
                    $('#pregnant-div,#spayed-div').css('display','none');
                    $('#castrated-div').css('display','block');
                    $("#caretaker_id").val('').trigger('change') ;
                    $('#imagePreview').css('display','none');
                }
            });
        }
    });

</script>
@endpush