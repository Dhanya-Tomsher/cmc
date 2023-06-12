@extends('admin.layouts.app', ['body_class' => '', 'title' => 'New User'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">
                            @if(isset($user->id))
                                Edit User
                            @else
                                Create New User
                            @endif
                        </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('users') }}">Users</a>
                            </li>

                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('users') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
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
                        <form name="frm" action="{{ route('users.store') }}" enctype="multipart/form-data"  method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ (isset($user->id) ? $user->id : '') }}">
                                    <label for="Name" class="col-form-label"><b>User Type</b> <span class="required">*</span></label>
                                    <select class="form-control" name="user_type"  id="user_type">
                                        @php  $user_type = (isset($user->user_type) ? $user->user_type : ''); @endphp
                                        <option {{ (old('user_type') == '' ||  $user_type == '' )  ? 'selected' : ''  }} value="">Select user type</option>
                                        <option {{ (old('user_type') == 'admin' ||  $user_type == 'admin' ) ? 'selected' : ''  }} value="admin">Admin</option>
                                        <option {{ (old('user_type') == 'staff' ||  $user_type == 'staff' ) ? 'selected' : ''  }} value="staff">Staff</option>
                                    </select>   
                                    @error('user_type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Name</b> <span class="required">*</span></label>
                                    <input class="form-control" name="name" value="{{ old('name',(isset($user->name) ? $user->name : '')) }}" type="text" placeholder="Enter user name" id="name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Email</b> <span class="required">*</span></label>
                                    <input class="form-control" name="email" value="{{ old('email',(isset($user->email) ? $user->email : '')) }}" type="email" placeholder="Enter user email" id="email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="password" class="col-form-label"><b>Password</b> <span class="required">*</span></label>
                                    <input class="form-control" name="password" value="{{ old('password') }}" autocomplete="new-password" type="password" placeholder="Enter password" id="password">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Phone Number</b> </label>
                                    <input class="form-control" name="phone_number" value="{{ old('phone_number',(isset($user->phone_number) ? $user->phone_number : '')) }}" type="text" placeholder="Enter user phone_number" id="phone_number">
                                </div>
                                @if(isset($user->is_active))
                                    <div class="col-md-8 offset-md-2">
                                        <label for="Name" class="col-form-label"><b>Status</b> </label>
                                        <select class="form-control" name="is_active" id="is_active ">
                                            <option {{ (old('is_active') == '1' ||  $user->is_active == '1' )  ? 'selected' : ''  }} value="1">Active</option>
                                            <option {{ (old('is_active') == '0' ||  $user->is_active == '0' )  ? 'selected' : ''  }} value="0">InActive</option>
                                        </select>
                                    </div>
                                @endif
                                
                                <div class="col-md-8 offset-md-2 mt-4">
                                    <div class="">
                                        <button name="Submit" type="Submit"  class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
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
<style>
.ck-editor__editable_inline {
    height: 500px;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>

<script type="text/javascript">
    ClassicEditor .create( document.querySelector( '#content' ), {
        width:['250px'],
        removePlugins: ["EasyImage","ImageUpload","MediaEmbed"]
    } )
    .catch( error => {
        console.log( error );
    } );
</script>
@endpush