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
                            </ol>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ Session::has('last_url') ? Session::get('last_url') : route('vet.index') }}" href="javascript:void" class="btn btn_back waves-effect waves-light"> <i
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
                            <form action="#">
                                <div class="row mb-3">
                                    <div class="col-10">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url('{{ $image }}');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center p-2">
                                        <a class="btn btn-danger waves-effect waves-light w-xl me-2 p-3" onclick="delete_Vet('{{ $vet[0]->id }}');" id="deleteVet">Delete Vet</a>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" value="{{ $vet[0]->name }}" id="Name" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea disabled required="" class="form-control"  rows="2">{{ $vet[0]->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input disabled class="form-control" type="email" value="{{ $vet[0]->email }}" id="Email">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input disabled class="form-control" value="{{ $vet[0]->phone_number }}" type="text" id="phone">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input disabled class="form-control" value="{{ $vet[0]->whatsapp_number }}"
                                            type="text" id="whatsapp">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <input type="text" class="form-control" value="{{ $vet[0]->country }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">State</label>
                                        <input type="text" class="form-control" value="{{ $vet[0]->state }}" disabled>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Gender</label>
                                        <select disabled class="form-select form-control" name="gender">
                                            <option>{{ $vet[0]->gender }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Name</label>
                                        <input disabled class="form-control" name="color_name" type="text" value="{{ $vet[0]->color_name }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Color Code</label>
                                        <input disabled class="form-control" name="color_code" type="text" value="{{ $vet[0]->color_code }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Emirates ID</label>
                                        <input disabled class="form-control" name="emirates_id" type="text" value="{{ $vet[0]->emirates_id }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">License Number</label>
                                        <input disabled class="form-control" name="license_number" type="text" value="{{ $vet[0]->license_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Designation</label>
                                        <input disabled class="form-control" name="designation" type="text" value="{{ $vet[0]->designation }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Specialization</label>
                                        <input disabled class="form-control" name="specialization" type="text" value="{{ $vet[0]->specialization }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label">Shift Time</label>
                                        <input disabled class="form-control" name="shift_from" type="text" value="{{ ($vet[0]->shift_from) ? date('h:i a', strtotime($vet[0]->shift_from)) : '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="work-number" class="col-form-label opacity-0">.</label>
                                        <input disabled class="form-control" name="specialization" type="text" value="{{ ($vet[0]->shift_to) ? date('h:i a', strtotime($vet[0]->shift_to)) : '' }}">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Status</label>
                                        <input disabled class="form-control" name="status" type="text" value="{{ ucfirst($vet[0]->status) }}">
                                    </div> --}}
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function delete_Vet(id){
        var el = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Vet?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            if (result.isConfirmed) {
                var data = []
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('vet.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
                    
                        Swal.fire(
                            'Deleted successfully',
                            '',
                            'success'
                        );
                        setTimeout(function() {
                            window.location.href = "{{ route('vet.index')}}";
                        }, 2000);
                    }
                });
            } 
            
        })
    }
</script>
@endpush
