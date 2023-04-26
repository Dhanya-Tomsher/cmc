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
                                <li class="breadcrumb-item active"><a href="{{ route('caretaker.index') }}">Caretaker
                                        Details</a></li>
                                <li class="breadcrumb-item active">Caretaker Details Edit</li>

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
                            <form name="frm" action="{{ route('caretaker.store') }}" enctype="multipart/form-data"
                                method="POST">
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
                                    {{-- <div class="col-md-4">
                                        <label for="example-text-input" class="col-form-label">Customer ID</label>
                                        <input class="form-control" name="customer_id" type="text"
                                            id="example-text-input">
                                    </div> --}}
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter Name"
                                            id="Name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea required="" name="address" class="form-control" placeholder="Enter address" rows="2">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input class="form-control" name="email" type="email"
                                            placeholder="Enter Email ID" id="Email" value="{{ old('name') }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input class="form-control" name="phone_number" type="text"
                                            placeholder="Enter Phone Number" id="phone"
                                            value="{{ old('phone_number') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input class="form-control" name="whatsapp_number" type="text"
                                            placeholder="Enter Whatsapp Number" id="whatsapp"
                                            value="{{ old('whatsapp_number') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <select class="form-select form-control" name="home_country">
                                            <option value="0" selected disabled>Select</option>
                                            @foreach ($countries as $item)
                                                <option {{ old('home_country') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <select class="form-select form-control" name="emirate">
                                            <option value="0" selected disabled>Select</option>
                                            <option {{ old('emirate') == 'Abu Dhabi' ? 'selected' : '' }}
                                                value="Abu Dhabi">
                                                Abu Dhabi</option>
                                            <option {{ old('emirate') == 'Dubai' ? 'selected' : '' }} value="Dubai">Dubai
                                            </option>
                                            <option {{ old('emirate') == 'Sharjah' ? 'selected' : '' }} value="Sharjah">
                                                Sharjah</option>
                                            <option {{ old('emirate') == 'Ajman' ? 'selected' : '' }} value="Ajman">Ajman
                                            </option>
                                            <option {{ old('emirate') == 'Umm Al Quwain' ? 'selected' : '' }}
                                                value="Umm Al Quwain">Umm Al Quwain</option>
                                            <option {{ old('emirate') == 'Ras Al Khaimah' ? 'selected' : '' }}
                                                value="Ras Al Khaimah">Ras Al Khaimah</option>
                                            <option {{ old('emirate') == 'Fujairah' ? 'selected' : '' }} value="Fujairah">
                                                Fujairah</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Place</label>
                                        <input class="form-control" name="work_place" type="text"
                                            placeholder="Enter Work Place" value="{{ old('work_place') }}">
                                        @error('work_place')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Address</label>
                                        <input class="form-control" name="work_address" type="text"
                                            placeholder="Enter Work Address" value="{{ old('work_address') }}">
                                        @error('work_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Position</label>
                                        <input class="form-control" name="position" type="text"
                                            placeholder="Enter Position" value="{{ old('position') }}">
                                        @error('position')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Work Contact Number</label>
                                        <input class="form-control" name="work_contact_number" type="text"
                                            placeholder="Enter Work Contact Number" id="work-number"
                                            value="{{ old('work_contact_number') }}">
                                        @error('work_contact_number')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                        <label for="emirates-id" class="col-form-label d-block">Passport No</label>
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
                                            <input class="form-control" name="passport_number" type="text"
                                                placeholder="Enter Passport No" id="input1" style="display: none;"
                                                value="{{ old('passport_number') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4 passport_input align-items-center" id="input3">
                                        <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
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
                                            <input class="form-control" name="emirates_id_number" type="text"
                                                placeholder="Enter Emirates ID" id="input2" style="display: none;"
                                                value="{{ old('emirates_id_number') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Visa Status</label>
                                        <select required class="form-select form-control" name="visa_status">
                                            <option value="0" selected disabled>Select</option>
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
