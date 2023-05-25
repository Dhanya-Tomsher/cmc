@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Edit Cat'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Edit Cat Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('cat.index') }}">Cat Deatails</a></li>
                            <li class="breadcrumb-item active">Cat Deatails Edit</li>
                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a onclick="window.location=document.referrer;" href="javascript:void" class="btn btn_back waves-effect waves-light mt-3"> <i
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
                        @if($cat[0])
                        <div class="card">
                            <div class="card-body py-4">
                                <form name="cat_update" id="updateCat" action="{{ route('cat.update', $cat[0]->id) }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="avatar-upload cat-avatar-upload">
                                                <div class="avatar-edit image-edit">
                                                    <input type='file' name="image" id="imageUpload" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp" />
                                                    <label for="imageUpload" class="image-upload-label"><i class="uil uil-pen font-size-18"></i> </label>
                                                </div>
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
                                            <label for="example-text-input" class="col-form-label">Caretaker ID<span class="required">*</span></label>
                                            <input type="hidden" name="catId" id="catId" value="{{ $cat[0]->id }}">
                                            <input type="hidden" name="image_url" value="{{ $cat[0]->image_url }}">
                                            <select class="form-select form-control" name="caretaker_id"  id="caretaker_id">
                                                <option value="" >Select Caretaker</option>
                                                @foreach ($caretakers as $ct)
                                                    <option {{ $cat[0]->caretaker_id == $ct['id'] ? 'selected' : '' }} value="{{ $ct['id'] }}">{{ $ct['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="col-form-label">Cat ID<span class="required">*</span></label>
                                            <input class="form-control" value="{{ $cat[0]->cat_id }}" name="cat_id" id="cat_id" type="text" id="example-text-input">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="Name" class="col-form-label">Name<span class="required">*</span></label>
                                            <input class="form-control" value="{{ $cat[0]->name }}"  name="name" type="text" placeholder="Enter Name" id="Name">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address" class="col-form-label">Date of Birth<span class="required">*</span></label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" value="{{ $cat[0]->date_birth }}" name="date_birth" class="form-control date-picker" placeholder="yyyy-mm-dd"
                                                    data-date-format="yyyy-mm-dd" data-date-container="#datepicker1" data-provide="datepicker" data-date-autoclose="true">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="emirates-id" class="col-form-label d-block">Blood Type<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodA" {{ $cat[0]->blood_type == "a" ? 'checked' : '' }} value="a" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodA">A</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodB" {{ $cat[0]->blood_type == "b" ? 'checked' : '' }} value="b" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodB">B</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodAB" {{ $cat[0]->blood_type == "ab" ? 'checked' : '' }} value="ab" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodAB">AB</label>
                                                </div>

                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodMic" {{ $cat[0]->blood_type == "mic" ? 'checked' : '' }} value="mic" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodMic">mic</label>
                                                </div>

                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="BloodUnknown" {{ $cat[0]->blood_type == "unknown" ? 'checked' : '' }} value="unknown" name="blood_type" class="form-check-input">
                                                    <label class="form-check-label" for="BloodUnknown">Default</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 input4" >
                                            <label for="emirates-id" class="col-form-label d-block">Virus<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="virusYes" value="1" name="virusstatus" {{ $cat[0]->virus == "1" ? 'checked' : '' }} class="form-check-input">
                                                    <label class="form-check-label" for="virusYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="virusNo" value="0" name="virusstatus" {{ $cat[0]->virus == "0" ? 'checked' : '' }} class="form-check-input">
                                                    <label class="form-check-label" for="virusNo">No</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="virusUnknown" value="2" {{ $cat[0]->virus == "2" ? 'checked' : '' }} name="virusstatus" class="form-check-input">
                                                    <label class="form-check-label" for="virusUnknown">Unknown</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="emirates-id" class="col-form-label d-block">Gender<span class="required">*</span></label>
                                            <div class="d-flex h-50 align-items-center border-bottom-1">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="GenderMale" {{ $cat[0]->gender == "Male" ? 'checked' : '' }}  value="Male" name="gender" class="form-check-input" value="hide" >
                                                    <label class="form-check-label" for="GenderMale">Male</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="GenderFemale" {{ $cat[0]->gender == "Female" ? 'checked' : '' }} value="Female" name="gender" class="form-check-input" value="show">
                                                    <label class="form-check-label" for="GenderFemale">Female</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 input4" >
                                            <label for="emirates-id" class="col-form-label d-block">Neutered<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredYes" value="1" {{ $cat[0]->neutered == "1" ? 'checked' : '' }}  name="neutered" class="form-check-input">
                                                    <label class="form-check-label" for="NeuteredYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredNo" value="0" {{ $cat[0]->neutered == "0" ? 'checked' : '' }} name="neutered" class="form-check-input">
                                                    <label class="form-check-label" for="NeuteredNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 input4" >
                                            <label for="emirates-id" class="col-form-label d-block">Neutered with Us<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredWithYes" value="1" {{ $cat[0]->neutered_with_us == "1" ? 'checked' : '' }}  name="neutered_with_us" class="form-check-input">
                                                    <label class="form-check-label" for="NeuteredWithYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="NeuteredWithNo" value="0" {{ $cat[0]->neutered_with_us == "0" ? 'checked' : '' }}   name="neutered_with_us" class="form-check-input">
                                                    <label class="form-check-label" for="NeuteredWithNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 input4 {{ $cat[0]->gender == "Male" ?  "hide" : '' }}"  id="spayed-div">
                                            <label for="emirates-id" class="col-form-label d-block">Spayed<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="SpayedYes" value="1" {{ $cat[0]->spayed == "1" ? 'checked' : '' }} name="spayed" class="form-check-input">
                                                    <label class="form-check-label" for="SpayedYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="SpayedNo" value="0" {{ $cat[0]->spayed == "0" ? 'checked' : '' }} name="spayed" class="form-check-input">
                                                    <label class="form-check-label" for="SpayedNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 input4 {{ $cat[0]->gender == "Female" ?  "hide" : '' }}"  id="castrated-div">
                                            <label for="emirates-id" class="col-form-label d-block">Castrated<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="CastratedYes" value="1" {{ $cat[0]->castrated == "1" ? 'checked' : '' }}  name="castrated" class="form-check-input">
                                                    <label class="form-check-label" for="CastratedYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="CastratedNo" value="0" {{ $cat[0]->castrated == "0" ? 'checked' : '' }}  name="castrated" class="form-check-input">
                                                    <label class="form-check-label" for="CastratedNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 input4 {{ $cat[0]->gender == "Male" ?  "hide" : '' }}"   id="pregnant-div">
                                            <label for="emirates-id" class="col-form-label d-block">Pregnant /  Not<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="PregnantYes"  {{ $cat[0]->pregnant == "1" ? 'checked' : '' }} value="1" name="pregnantstatus" class="form-check-input">
                                                    <label class="form-check-label" for="PregnantYes">Yes</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="PregnantNo"  {{ $cat[0]->pregnant == "0" ? 'checked' : '' }} value="0" name="pregnantstatus" class="form-check-input">
                                                    <label class="form-check-label" for="PregnantNo">No</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="PregnantUnknown"  {{ $cat[0]->pregnant == "2" ? 'checked' : '' }} value="2" name="pregnantstatus" class="form-check-input">
                                                    <label class="form-check-label" for="PregnantUnknown">Unknown</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="FurColor" class="col-form-label">Fur / Color<span class="required">*</span></label>
                                            <input type="text" value="{{  $cat[0]->fur_color }}" name="fur_color" class="form-control" id="FurColor"  placeholder="Enter Fur / Color">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="EyeColor" class="col-form-label">Eye Color<span class="required">*</span></label>
                                            <input type="text" value="{{ $cat[0]->eye_color }}" name="eye_color" class="form-control" id="EyeColor" placeholder="Enter Eye Color">
                                        </div>

                                        <div class="col-md-6 input4" id="behaviour-div">
                                            <label for="emirates-id" class="col-form-label d-block">Behaviour<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourGreen" value="1" {{ $cat[0]->behaviour == "1" ? 'checked' : '' }}  name="behaviour" class="form-check-input" >
                                                    <label class="form-check-label" for="behaviourGreen">Green</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourOrange" value="2" {{ $cat[0]->behaviour == "2" ? 'checked' : '' }}  name="behaviour" class="form-check-input">
                                                    <label class="form-check-label" for="behaviourOrange">Orange</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="behaviourRed" value="3" {{ $cat[0]->behaviour == "3" ? 'checked' : '' }}  name="behaviour" class="form-check-input" >
                                                    <label class="form-check-label" for="behaviourRed">Red</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label">Place of Origin<span class="required">*</span></label>
                                            <select class="form-select form-control" name="place_of_origin">
                                                <option value="0" selected disabled>Select</option>
                                                @foreach ($countries as $item)
                                                    <option {{ $cat[0]->place_of_origin == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label">Emirate<span class="required">*</span></label>
                                            <select class="form-select form-control" name="emirate">
                                                <option value="0" selected disabled>Select</option>
                                                <option {{ $cat[0]->emirate == 'Abu Dhabi' ? 'selected' : '' }} value="Abu Dhabi">Abu Dhabi</option>
                                                <option {{ $cat[0]->emirate == 'Dubai' ? 'selected' : '' }} value="Dubai">Dubai</option>
                                                <option {{ $cat[0]->emirate == 'Sharjah' ? 'selected' : '' }} value="Sharjah">Sharjah</option>
                                                <option {{ $cat[0]->emirate == 'Ajman' ? 'selected' : '' }} value="Ajman">Ajman</option>
                                                <option {{ $cat[0]->emirate == 'Umm Al Quwain' ? 'selected' : '' }} value="Umm Al Quwain">Umm Al Quwain</option>
                                                <option {{ $cat[0]->emirate == 'Ras Al Khaimah' ? 'selected' : '' }} value="Ras Al Khaimah">Ras Al Khaimah</option>
                                                <option {{ $cat[0]->emirate == 'Fujairah' ? 'selected' : '' }} value="Fujairah">Fujairah</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label">Origin / History<span class="required">*</span></label>
                                            <input type="text" value="{{ $cat[0]->origin }}" name="origin" class="form-control" placeholder="Enter Origin / History">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="microchip_number" class="col-form-label">Microchip Number<span class="required">*</span></label>
                                            <input class="form-control"  value="{{ $cat[0]->microchip_number }}" name="microchip_number" type="text" placeholder="Enter Microchip Number" id="microchip_number">
                                        </div>

                                        <div class="col-md-6 align-self-end">
                                            <label for="emirates-id" class="col-form-label d-block">Dead / Alive<span class="required">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="Alive" value="1" {{ $cat[0]->dead_alive == "1" ? 'checked' : '' }} name="dead_alive" class="form-check-input" checked>
                                                    <label class="form-check-label" for="Alive">Alive</label>
                                                </div>
                                                <div class="custom-radio form-check form-check-inline">
                                                    <input type="radio" id="Dead" value="0" {{ $cat[0]->dead_alive == "0" ? 'checked' : '' }} name="dead_alive"  class="form-check-input">
                                                    <label class="form-check-label" for="Dead">Dead </label>
                                                </div>

                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12 align-self-end mt-5">
                                            <div class="">
                                                <button name="Submit" type="Submit"  class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
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
     $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
    $('input[name="gender"]').on('click',function(){
        if($(this).val() == 'Female'){
            $('#pregnant-div,#spayed-div').css('display','block');
            $('#castrated-div').css('display','none');
            $('#pregnant-div,#spayed-div').removeClass('hide');
        }else{
            $('#pregnant-div,#spayed-div').css('display','none');
            $('#castrated-div').css('display','block');
            $('#castrated-div').removeClass('hide');
        }
    });

    $('#caretaker_id').select2({
        placeholder: 'Select Caretaker',
        // dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });

    $.validator.addMethod("checkExists", function(value, element){
        var data = 0;
        $.ajax({
            type: "POST",
            url: "{{ route('cat.check-availability')}}",
            async: false,
            data: "cat_id="+value +"&id="+$('#catId').val(), 
            success: function(returnData)
            {
                data = (returnData === 'true') ? 1 :0;
            }
        });
        return data;
    }, 'This Cat ID already exists');

    $("#updateCat").validate({
        rules: {
            name: "required",
            caretaker_id: "required",
            date_birth: "required",
            fur_color: "required",
            eye_color: "required",
            place_of_origin: "required",
            emirate: "required",
            origin: "required",
            microchip_number: "required",
            image_url: {
                required: true,
                extension: "jpg|jpeg|png|ico|bmp"
            },
            cat_id:{
                    required: true,
                    checkExists : true
            }
        },
        messages: {
            caretaker_id: " Please select a caretaker",
            name: " Please enter a name",
            cat_id:{
                    required: "Please enter Cat ID.",
                    checkExists: "This Cat ID already exists."
            },
            date_birth: "Date of birth is required",
            fur_color: "Fur/color is required",
            eye_color: "Eye color is required",
            place_of_origin: "Place of origin is required",
            emirate: "Emirate is required",
            origin: "Origin / History is required",
            microchip_number: "Microchip number is required",
            image_url: {
                required:"Please select an Image file",
                extension:"Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
            },
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2')) {
                error.insertAfter(element.next('.select2-container'));
            }else{
                error.appendTo(element.parent("div"));
            }
        },
        submitHandler: function(e) { 
            var data = new FormData($('#updateCat')[0]);
            $.ajax({
                url: "{{ route('cat.update') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        'Cat details updated successfully!',
                        'success'
                    );
                }
            });
        }
    });

</script>
@endpush