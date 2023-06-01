@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">Vet Details</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="caretaker_details.html">Vet Details</a></li>
                                <li class="breadcrumb-item active">Vet Details Edit</li>

                            </ol>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('vet.index')}}" href="javascript:void" class="btn btn_back waves-effect waves-light"> <i
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
                        @if(session()->has('status'))
                                        <div class="alert alert-success">
                                            {{ session()->get('status') }}
                                        </div>
                                    @endif
                            <form name="frm" action="{{ route('vet.update', $vet) }}" enctype="multipart/form-data"
                                method="POST" id="saveVet">
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
                                                    style="background-image: url('{{ asset($vet->image_url) }}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Name"
                                            value="{{ $vet->name }}" id="Name">
                                        <span id="name_error" class="error"  style="display:none;"> Name is required </span>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea required="" name="address" class="form-control" placeholder="Enter address" rows="2">{{ $vet->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input class="form-control" name="email" id="email" type="email"
                                            value="{{ $vet->email }}" placeholder="Enter Email ID" id="Email">
                                        <span id="email_error" class="error"  style="display:none;"> Email is required </span>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input class="form-control" name="phone_number" value="{{ $vet->phone_number }}"
                                            type="text" placeholder="Enter Phone Number" id="phone">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input class="form-control" name="whatsapp_number"
                                            value="{{ $vet->whatsapp_number }}" type="text"
                                            placeholder="Enter Whatsapp Number" id="whatsapp">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <select name="home_country" class="form-select form-control">
                                            @foreach ($countries as $item)
                                                <option {{ $vet->home_country == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <select class="form-select form-control" name="emirate">
                                            <option {{ $vet->emirate == 'Dubai' ? 'selected' : '' }} value="Dubai">Abu
                                                Dhabi</option>
                                            <option {{ $vet->emirate == 'Dubai' ? 'selected' : '' }} value="Dubai">Dubai
                                            </option>
                                            <option {{ $vet->emirate == 'Sharjah' ? 'selected' : '' }} value="Sharjah">
                                                Sharjah</option>
                                            <option {{ $vet->emirate == 'Ajman' ? 'selected' : '' }} value="Ajman">Ajman
                                            </option>
                                            <option {{ $vet->emirate == 'Umm Al Quwain' ? 'selected' : '' }}
                                                value="Umm Al Quwain">Umm Al Quwain</option>
                                            <option {{ $vet->emirate == 'Ras Al Khaimah' ? 'selected' : '' }}
                                                value="Ras Al Khaimah">Ras Al Khaimah</option>
                                            <option {{ $vet->emirate == 'Fujairah' ? 'selected' : '' }} value="Fujairah">
                                                Fujairah</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Gender</label>
                                        <select class="form-select form-control" name="gender">
                                            <option {{ $vet->gender == 'Male' ? 'selected' : '' }} value="Male">Male
                                            </option>
                                            <option {{ $vet->gender == 'Female' ? 'selected' : '' }} value="Female">Female
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Name</label>
                                        <input class="form-control" name="color_name" type="text"
                                            placeholder="Enter Color Name" value="{{ $vet->color_name }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Code</label>
                                        <input class="form-control" name="color_code" type="text"
                                            placeholder="Enter Color Code" value="{{ $vet->color_code }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Emirates ID</label>
                                        <input class="form-control" name="emirates_id" type="text"
                                            placeholder="Emirates ID" value="{{ $vet->emirates_id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">License Number</label>
                                        <input class="form-control" name="license_number" type="text"
                                            placeholder="Licence Number" value="{{ $vet->license_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Designation</label>
                                        <input class="form-control" name="designation" type="text"
                                            placeholder="Designation" value="{{ $vet->designation }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Specialization</label>
                                        <input class="form-control" name="specialization" type="text"
                                            placeholder="Specialization" value="{{ $vet->specialization }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label">Shift Time</label>
                                        <select class="form-select form-control "  id="shift_from" name="shift_from">
                                            <option value="">From</option>
                                            @if($timeSlots)
                                                @foreach($timeSlots as $key => $slot)
                                                    <option {{ $vet->shift_from ==  $key ? 'selected' : '' }} value="{{ $key }}"> {{ $slot }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="from_error" class="error" style="display:none;"> From time is required </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label opacity-0">.</label>
                                        <select class="form-select form-control"  id="shift_to" name="shift_to">
                                            <option value="">To</option>
                                            @if($timeSlots)
                                                @foreach($timeSlots as $key => $slot)
                                                    <option {{ $vet->shift_to ==  $key ? 'selected' : '' }} value="{{ $key }}"> {{ $slot }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="to_error" class="error" style="display:none;"> To time is required </span>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <label for="country" class="col-form-label">Status</label>
                                        <select class="form-select form-control" name="status">
                                            <option {{ $vet->status == 'published' ? 'selected' : '' }} value="published">
                                                Published
                                            </option>
                                            <option {{ $vet->status == 'draft' ? 'selected' : '' }} value="draft">Draft
                                            </option>
                                        </select>
                                    </div> -->

                                    <div class="col-md-4 align-self-end mt-3">
                                        <div class="">
                                            <button name="Submit" type="button"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2" id="save">Update</button>
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
@endpush

@push('footer')
<script>
    
    $("#save").click(function (e) {
        $('#from_error,#to_error,#name_error,#email_error').css('display','none');
        flag = true;
        if($('#shift_from').val() == ''){
            flag = false;
            $('#from_error').css('display','block');
        }
        if($('#shift_to').val() == ''){
            flag = false;
            $('#to_error').css('display','block');
        }
        if($('#name').val() == ''){
            flag = false;
            $('#name_error').css('display','block');
        }
        if($('#email').val() == ''){
            flag = false;
            $('#email_error').css('display','block');
        }
        if(flag == false){
            e.preventDefault();
        }else{
            $('#saveVet').submit();
        }
    });
</script>
@endpush