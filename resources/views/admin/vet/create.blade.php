@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">Vets Details</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('vet.index') }}">Vets Details</a></li>
                                <li class="breadcrumb-item active">Vets Details Edit</li>

                            </ol>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a  href="{{ route('vet.index') }}" class="btn btn_back waves-effect waves-light"> <i
                                class="uil-angle-left-b"></i> Back</a>
                        {{-- <div class="btn_group">
                            <a href="dashboard.html" class="btn btn_back waves-effect waves-light me-2"> Register Cat</a>
                            <a href="dashboard.html" class="btn btn_back waves-effect waves-light"> Blacklist </a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            <form name="frm" action="{{ route('vet.store') }}" id="saveVet" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-edit">
                                                <input type='file' name="image" id="imageUpload"
                                                    accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"><i class="uil uil-pen font-size-18"></i> </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url('{{ asset('assets/images/user_img.png') }}');">
                                                </div>
                                            </div>
                                        </div>
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name<span class="required">*</span></label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter Name"
                                            id="Name"  value="{{ old('name') }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea  name="address" class="form-control" placeholder="Enter address" rows="2">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID<span class="required">*</span></label>
                                        <input class="form-control" name="email" type="email"
                                            placeholder="Enter Email ID" id="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number<span class="required">*</span></label>
                                        <input class="form-control" name="phone_number" type="text"
                                            placeholder="Enter Phone Number" id="phone" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input class="form-control" name="whatsapp_number" type="text"
                                            placeholder="Enter Whatsapp Number" id="whatsapp" value="{{ old('whatsapp_number') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <select class="form-select form-control select2" name="home_country" id="home_country">
                                            <option value="" selected disabled>Select</option>
                                            @foreach ($countries as $item)
                                                <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">State</label>
                                        <select class="form-select form-control select2" name="emirate" id="state">
                                            <option value="" selected disabled>Select</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Gender</label>
                                        <select class="form-select form-control" name="gender">
                                            <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Name</label>
                                        <input class="form-control" name="color_name" type="text"
                                            placeholder="Enter Color Name" value="{{ old('color_name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Code</label>
                                        <input class="form-control" name="color_code" type="text"
                                            placeholder="Enter Color Code" value="{{ old('color_code') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Emirates ID</label>
                                        <input class="form-control" name="emirates_id" type="text"
                                            placeholder="Emirates ID" value="{{ old('emirates_id') }}"> 
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">License Number</label>
                                        <input class="form-control" name="license_number" type="text"
                                            placeholder="Licence Number" value="{{ old('license_number') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Designation</label>
                                        <input class="form-control" name="designation" type="text"
                                            placeholder="Designation" value="{{ old('designation') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Specialization</label>
                                        <input class="form-control" name="specialization" type="text"
                                            placeholder="Specialization" value="{{ old('specialization') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label">Shift Time</label>
                                        <select class="form-select form-control "  id="shift_from" name="shift_from">
                                            <option value="">From</option>
                                            @if($timeSlots)
                                                @foreach($timeSlots as $key => $slot)
                                                    <option {{ old('shift_from') == $key ? 'selected' : '' }} value="{{ $key }}"> {{ $slot }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('shift_from')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label opacity-0">.</label>
                                        <select class="form-select form-control"  id="shift_to" name="shift_to">
                                            <option value="">To</option>
                                            @if($timeSlots)
                                                @foreach($timeSlots as $key => $slot)
                                                    <option {{ old('shift_to') == $key ? 'selected' : '' }} value="{{ $key }}"> {{ $slot }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('shift_to')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 align-self-end mt-3">
                                        <div class="">
                                            <button name="Submit" type="submit"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2" id="save">Save</button>
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
</script>
@endpush
