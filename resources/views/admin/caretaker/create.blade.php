@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Register Caretaker'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">Create Caretaker</h4>
                        </div>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="#">Create Caretaker</a></li>

                            </ol>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('caretaker.index') }}" class="btn btn_back waves-effect waves-light"> <i
                                class="uil-angle-left-b"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            @if(session()->has('status'))
                                <div class="alert alert-success">
                                    {{ session()->get('status') }}
                                </div>
                            @endif
                            <form name="frm" id="createCaretaker" action="{{ route('caretaker.store') }}" enctype="multipart/form-data" method="POST" autocomplete="off">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-edit">
                                                <input type="file" class="sr-only" id="imageUpload" name="image"
                                                    accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp">
                                                <label for="imageUpload"><i class="uil uil-pen font-size-18"></i> </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url('{{ asset('assets/images/user_img.png') }}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="example-text-input" class="col-form-label">Customer ID<span class="required">*</span></label>
                                        <input class="form-control" name="customer_id" readonly type="text" value="{{ $careId }}"  placeholder="Enter Customer ID" id="example-text-input">
                                      
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name<span class="required">*</span></label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter Name" value="{{ old('name') }}" id="Name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address<span class="required">*</span></label>
                                        <textarea  name="address" class="form-control" placeholder="Enter address" rows="2">{{ old('address') }}</textarea>
                                       
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID<span class="required">*</span></label>
                                        <input class="form-control" name="email" type="text"
                                            placeholder="Enter Email ID" id="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number<span class="required">*</span></label>
                                        <input class="form-control" name="phone_number" type="text"
                                            placeholder="Enter Phone Number" id="phone"
                                            value="{{ old('phone_number') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number<span class="required">*</span></label>
                                        <input class="form-control" name="whatsapp_number" type="text"
                                            placeholder="Enter Whatsapp Number" id="whatsapp"
                                            value="{{ old('whatsapp_number') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country<span class="required">*</span></label>
                                        <select class="form-select form-control select2" name="home_country" id="home_country">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">State</label>
                                        <select class="form-select form-control select2" name="emirate"  id="state">
                                           
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Place<span class="required">*</span></label>
                                        <input class="form-control" name="work_place" type="text"
                                            placeholder="Enter Work Place" value="{{ old('work_place') }}">
                                       
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Address<span class="required">*</span></label>
                                        <input class="form-control" name="work_address" type="text"
                                            placeholder="Enter Work Address" value="{{ old('work_address') }}">
                                      
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Position<span class="required">*</span></label>
                                        <input class="form-control" name="position" type="text"
                                            placeholder="Enter Position" value="{{ old('position') }}">
                                     
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Work Contact Number<span class="required">*</span></label>
                                        <input class="form-control" name="work_contact_number" type="text"
                                            placeholder="Enter Work Contact Number" id="work-number"
                                            value="{{ old('work_contact_number') }}">
                                      
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                        <label for="emirates-id" class="col-form-label d-block">Passport No<span class="required">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportYes" name="is_passport_no"
                                                    class="form-check-input" value="show">
                                                <label class="form-check-label" for="PassportYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportNo" name="is_passport_no"
                                                    class="form-check-input" value="hide" checked>
                                                <label class="form-check-label" for="PassportNo">No</label>
                                            </div>
                                            
                                        </div>
                                        <div class="align-items-center mt-2">
                                            <input class="form-control" name="passport_number" type="text"
                                            placeholder="Enter Passport No" id="input1" style="display: none;"
                                            value="{{ old('passport_number') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4 passport_input align-items-center" id="input3">
                                        <label for="emirates-id" class="col-form-label d-block">Emirates ID<span class="required">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesYes" name="is_emirates_id"
                                                    class="form-check-input" value="show">
                                                <label class="form-check-label" for="EmiratesYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesNo" name="is_emirates_id"
                                                    class="form-check-input" value="hide" checked>
                                                <label class="form-check-label" for="EmiratesNo">No</label>
                                            </div>
                                        </div>
                                        <div class="align-items-center mt-2">
                                            <input class="form-control" name="emirates_id_number" type="text"
                                            placeholder="Enter Emirates ID" id="input2" style="display: none;"
                                            value="{{ old('emirates_id_number') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Visa Status<span class="required">*</span></label>
                                        <select  class="form-select form-control" name="visa_status">
                                            <option value="" >Select</option>
                                            <option value="Residence Visa"
                                                {{ old('visa_status') == 'Residence Visa' ? 'selected' : '' }}>Residence
                                                Visa</option>
                                            <option value="Tourist Visa"
                                                {{ old('visa_status') == 'Tourist Visa' ? 'selected' : '' }}>Tourist Visa
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 align-self-end mt-3">
                                        <div class="">
                                            <button name="submit" type="submit"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2" value="save">Save</button>
                                            <button name="submit" type="submit"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2" value="save_create">Save & Create Cat</button>
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

    $(document).on('change','#home_country', function(e){
        var country_id = $(this).val();
        $.ajax({
                url: "{{ route('get-states')}}",
                type: "POST",
                data: {'country_id' : country_id},
                success: function( response ) {
                   $('#state').html(response);
                }
            });
    })

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
                position : "required",
                work_contact_number:{
                    required: true,
                    digits: true
                },
                is_passport_no:"required",
                passport_number:"required",
                is_emirates_id:"required",
                emirates_id_number:"required",
                visa_status:"required",
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
                position : "Position is required",
                work_contact_number:{
                    required: "Work contact number is required",
                    digits: "Please enter a valid number"
                },
                is_passport_no:"Do you have Passport?",
                passport_number:"Passport Number  is required if you have Passport.",
                is_emirates_id:"Do you have Emirates ID?",
                emirates_id_number:"Emirates ID Number  is required if you have Emirates ID.",
                visa_status:"Visa status is required",
            },
            errorPlacement: function (error, element) {
                if(element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                }else{
                    error.appendTo(element.parent("div"));
                }
            },
            submitHandler: function(form) { 
                // var data = new FormData($('#createCaretaker')[0]);
                form.submit();
                // $.ajax({
                //     url: "{{ route('cat.store')}}",
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
@push('footer')
    <script>
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

        
    </script>
@endpush
