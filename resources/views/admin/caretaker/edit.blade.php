@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
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
                                <li class="breadcrumb-item active"><a href="{{ route('caretaker.index') }}">Caretaker
                                        Details</a></li>
                                <li class="breadcrumb-item active">Caretaker Details Edit</li>

                            </ol>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ Session::has('last_url') ? Session::get('last_url') : route('caretaker.index') }}" class="btn btn_back waves-effect waves-light"> <i
                                class="uil-angle-left-b"></i> Back</a>
                        <div class="btn_group">
                            <a href="{{ route('cat.create') }}" class="btn btn_back waves-effect waves-light me-2"> Register
                                Cat</a>
                            <!-- <a href="{{ route('caretaker.index') }}" class="btn btn_back waves-effect waves-light">  Blacklist </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            @if (session()->has('status'))
                                <div class="alert alert-success">
                                    {{ session()->get('status') }}
                                </div>
                            @endif
                            <form name="frm" id="createCaretaker" action="{{ route('caretaker.update', $caretaker) }}"
                                enctype="multipart/form-data" method="POST" autocomplete="off">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-edit">
                                                <input type='file' name="imageUrl" id="imageUpload"
                                                    accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp" />
                                                <label for="imageUpload"><i class="uil uil-pen font-size-18"></i> </label>
                                            </div>
                                            <div class="avatar-preview">
                                                @if ($caretaker->image_url == null)
                                                    <div id="imagePreview"
                                                        style="background-image: url('{{ asset('assets/images/user_img.png') }}');">
                                                    </div>
                                                @else
                                                    <div id="imagePreview"
                                                        style="background-image: url('{{ asset($caretaker->image_url) }}');">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="careId" value="{{ $caretaker->id }}">
                                        <input type="hidden" name="image_url" value="{{ $caretaker->image_url }}">
                                        <label for="example-text-input" class="col-form-label">Customer ID<span
                                                class="required">*</span></label>
                                        <input class="form-control" type="text" readonly name="customer_id"
                                            placeholder="Enter Customer ID"
                                            value="{{ old('customer_id', $caretaker->customer_id) }}"
                                            id="example-text-input">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="name" value="{{ old('name', $caretaker->name) }}" type="text" placeholder="Enter Name" id="Name" autocomplete="off">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address<span
                                            class="required">*</span></label>
                                        <textarea name="address" class="form-control" placeholder="Enter address" rows="2">{{ $caretaker->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="email"
                                            value="{{ old('email', $caretaker->email) }}" type="email"
                                            placeholder="Enter Email ID" id="Email">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="phone_number"
                                            value="{{ $caretaker->phone_number }}" type="text"
                                            placeholder="Enter Phone Number" id="phone">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="whatsapp_number"
                                            value="{{ $caretaker->whatsapp_number }}" type="text"
                                            placeholder="Enter Whatsapp Number" id="whatsapp">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country<span
                                            class="required">*</span></label>
                                        <select class="form-select form-control select2" name="home_country"
                                            id="home_country">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($countries as $item)
                                                <option {{ $caretaker->home_country == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">State</label>
                                        <select class="form-select form-control select2" name="emirate" id="state">
                                            <option value="">Select</option>
                                            @foreach ($states as $st)
                                                <option {{ $caretaker->state_id == $st->id ? 'selected' : '' }}
                                                    value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Place<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="work_place"
                                            value="{{ $caretaker->work_place }}" type="text"
                                            placeholder="Enter Work Place">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Address<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="work_address"
                                            value="{{ $caretaker->work_address }}" type="text"
                                            placeholder="Enter Work Address">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Position<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="position" value="{{ $caretaker->position }}"
                                            type="text" placeholder="Enter Position">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Work Contact Number<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="work_contact_number"
                                            value="{{ $caretaker->work_contact_number }}" type="text"
                                            placeholder="Enter Work Contact Number" id="work-number">
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                        <label for="emirates-id" class="col-form-label d-block">Passport No<span
                                            class="required">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportYes"
                                                    {{ $caretaker->is_passport_no == '1' ? 'checked' : '' }}
                                                    name="is_passport_no" class="form-check-input" value="show">
                                                <label class="form-check-label" for="PassportYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportNo" name="is_passport_no"
                                                    {{ $caretaker->is_passport_no == '0' ? 'checked' : '' }}
                                                    class="form-check-input" value="hide">
                                                <label class="form-check-label" for="PassportNo">No</label>
                                            </div>
                                        </div>
                                        <div class="align-items-center mt-2">
                                            <input class="form-control" type="text" name="passport_number" style="{{ $caretaker->is_passport_no == '0' ? 'display:none;' : '' }}" value="{{ $caretaker->passport_number }}" id="input1">
                                        </div>
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="input3">
                                        <label for="emirates-id" class="col-form-label d-block">Emirates ID<span
                                            class="required">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesYes" name="is_emirates_id"
                                                    class="form-check-input"
                                                    {{ $caretaker->is_emirates_id == '1' ? 'checked' : '' }}
                                                    value="show">
                                                <label class="form-check-label" for="EmiratesYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesNo" name="is_emirates_id"
                                                    class="form-check-input"
                                                    {{ $caretaker->is_emirates_id == '0' ? 'checked' : '' }}
                                                    value="hide">
                                                <label class="form-check-label" for="EmiratesNo">No</label>
                                            </div>
                                        </div>
                                        <div class="align-items-center mt-2">
                                            <input class="form-control" name="emirates_id_number" value="{{ $caretaker->emirates_id_number }}" style=" {{ $caretaker->is_emirates_id == '0' ? 'display:none;' : '' }}" type="text" placeholder="Enter Emirates ID" id="input2">
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Visa Status<span
                                            class="required">*</span></label>
                                        <select class="form-select form-control" name="visa_status">
                                            <option value="">Select</option>
                                            <option value="Residence Visa"
                                                {{ $caretaker->visa_status == 'Residence Visa' ? 'selected' : '' }}>
                                                Residence
                                                Visa</option>
                                            <option value="Tourist Visa"
                                                {{ $caretaker->visa_status == 'Tourist Visa' ? 'selected' : '' }}>Tourist
                                                Visa
                                            </option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-4">
                                                        <label for="country" class="col-form-label">Status</label>
                                                        <select class="form-select form-control" name="status">
                                                            <option {{ $caretaker->status == 'published' ? 'selected' : '' }} value="published">Published</option>
                                                            <option {{ $caretaker->status == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                                                        </select>
                                                    </div> -->
                                    <div class="col-md-4">
                                        <label for="emirates-id" class="col-form-label d-block">BlackList Status<span
                                            class="required">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="blacklistYes"
                                                    {{ $caretaker->is_blacklist == '1' ? 'checked' : '' }}
                                                    name="is_blacklist" class="form-check-input" value="1">
                                                <label class="form-check-label" for="blacklistYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="blacklistNo" name="is_blacklist"
                                                    {{ $caretaker->is_blacklist == '0' ? 'checked' : '' }}
                                                    class="form-check-input" value="0">
                                                <label class="form-check-label" for="blacklistNo">No</label>
                                            </div>

                                            <input class="form-control" type="text" name="blacklist_reason"
                                                style="{{ $caretaker->is_blacklist == '0' ? 'display:none;' : '' }}"
                                                value="{{ $caretaker->blacklist_reason }}"
                                                placeholder="Enter reason for blacklist" id="blacklistReason">

                                        </div>
                                    </div>

                                    <div class="col-md-4 align-self-end mt-3">
                                        <div class="">
                                            <button name="Submit" type="Submit"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->




        </div> <!-- container-fluid -->
    </div>
@endsection
@push('header')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $('.select2').select2({
            placeholder: 'Select',
            // dropdownParent: $('#createAppointmentModal'),
            width: 'resolve', // need to override the changed default
            allowClear: true,
        });

        $(document).on('change', '#home_country', function(e) {
            var country_id = $(this).val();
            $.ajax({
                url: "{{ route('get-states') }}",
                type: "POST",
                data: {
                    'country_id': country_id
                },
                success: function(response) {
                    $('#state').html(response);
                }
            });
        })

        $('input[name="is_passport_no"]').on('click', function() {
            if ($(this).val() === 'hide') {
                $('#input1').val('').hide();
            } else {
                $('#input1').show();
            }
        });
        $('input[name="is_emirates_id"]').on('click', function() {
            if ($(this).val() === 'hide') {
                $('#input2').val('').hide();
            } else {
                $('#input2').show();
            }
        });
        $('input[name="is_blacklist"]').on('click', function() {
            if ($(this).val() === '0') {
                $('#blacklistReason').val('').hide();
            } else {
                $('#blacklistReason').show();
            }
        });

        $("#createCaretaker").validate({
            rules: {
                customer_id: "required",
                name: "required",
                address: "required",
                email: {
                    required: true,
                    email: true
                },
                phone_number: {
                    required: true,
                    digits: true
                },
                whatsapp_number: {
                    required: true,
                    digits: true
                },
                home_country: "required",
                // emirate: "required",
                work_place: "required",
                work_address: "required",
                position: "required",
                work_contact_number: {
                    required: true,
                    digits: true
                },
                is_passport_no: "required",
                passport_number: "required",
                is_emirates_id: "required",
                emirates_id_number: "required",
                visa_status: "required",
            },
            messages: {
                customer_id: "Customer ID is required",
                name: "Name is required",
                address: "Address is required",
                email: {
                    required: "Email address is required",
                    email: "Please enter a valid email address"
                },
                phone_number: {
                    required: "Phone number is required",
                    digits: "Please enter a valid number"
                },
                whatsapp_number: {
                    required: "Whatsapp number is required",
                    digits: "Please enter a valid number"
                },
                home_country: "Home country is required",
                // emirate: "State is required",
                work_place: "Work place is required",
                work_address: "Work address is required",
                position: "Position is required",
                work_contact_number: {
                    required: "Work contact number is required",
                    digits: "Please enter a valid number"
                },
                is_passport_no: "Do you have Passport?",
                passport_number: "Passport Number  is required if you have Passport.",
                is_emirates_id: "Do you have Emirates ID?",
                emirates_id_number: "Emirates ID Number  is required if you have Emirates ID.",
                visa_status: "Visa status is required",
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.appendTo(element.parent("div"));
                }
            },
            submitHandler: function(form) {
                // var data = new FormData($('#createCaretaker')[0]);
                form.submit();
                // $.ajax({
                //     url: "{{ route('cat.store') }}",
                //     type: "POST",
                //     data: data,
                //     processData: false,
                //     contentType: false,
                //     success: function( response ) {
                //         Swal.fire(
                //             '',
                //             'Cat details added successfully!',
                //             'success'
                //         );
                //         var catid = ($('#cat_id').val()).replace('C','');
                //         $("#createCaretaker")[0].reset();
                //         $('#pregnant-div,#spayed-div').css('display','none');
                //         $('#castrated-div').css('display','block');
                //         $("#caretaker_id").val('').trigger('change') ;
                //         $("#home_country").val('').trigger('change') ;
                //         $("#state").val('').trigger('change') ;
                //         $('#imagePreview').css('background-image',"url('')");
                //         $('#imagePreview').css('background-image',"url('{{ asset('assets/images/cat_plc.jpg') }}')");
                //         $('#cat_id').val('C'+(parseInt(catid) +1));
                //     }
                // });
            }
        });
    </script>
@endpush
