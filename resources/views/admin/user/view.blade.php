@extends('admin.layouts.app', ['body_class' => '', 'title' => 'User Management'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">All Users</h4>
                        </div>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="#">All Users</a></li>
                            </ol>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="#" class=""> </a>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('user.create') }}" class="btn btn_back waves-effect waves-light w-xl" id="new_appointment">Create New User</a>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3 class="mb-3">Users</h3>
                                </div>
                            </div>
                        
                            <div class="table-responsive cat_details_table ">
                                <table class="table table-centered table-nowrap mb-0" id="catsTable" style="border-bottom:0px !important;">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="w-5">No</th>
                                            <th>Name</th>
                                            <th class="text-center w-10">User Type</th>
                                            <th class="text-center w-20">Email</th>
                                            <th class="text-center">Phone Number</th>
                                            <th class="text-center w-10">Active Status</th>
                                            <th class="text-center w-15">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="catDetails">
                                        @foreach ($users as $user)
                                            <tr id="appid_{{$user->id}}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td class="text-center">
                                                    @if ($user->user_type == 'vet')
                                                        <span class="badge bg-soft-success font-size-12">Vet </span>
                                                    @elseif ($user->user_type == 'admin')
                                                        <span class="badge bg-soft-primary font-size-12">Admin </span>
                                                    @elseif ($user->user_type == 'staff')
                                                        <span class="badge bg-soft-warning font-size-12">Staff </span>
                                                    @endif
                                            
                                                </td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->phone_number }}</td>
                                                <td  class="text-center">
                                                    @php  
                                                        $status = ($user->is_active == 1) ? '<span class="badge bg-soft-success font-size-12 text-uppercase">Active</span>' : '<span class="badge bg-soft-danger font-size-12 text-uppercase">InActive</span>';
                                                    @endphp
                                                    {!! $status !!}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('user.edit', $user) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-pen"></i>Edit</a>
                                                    @if(Auth::user()->id != $user->id)
                                                        <a href="#" onclick="deleteUser('{{$user->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Profile" class="px-1 btn btn-app"><i class="uil uil-trash"></i>Delete</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- container-fluid -->
    </div>
@endsection
@push('header')

<style>


</style>
@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// $('#catsTable').DataTable();  
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

function deleteUser(id){
        var el = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this user?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
        
            if (result.isConfirmed) {
                var data = [];
                $.ajax({
                    url: "{{ route('user.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
                        $('#appid_'+id).css('background','#f9a8a8');
                        $('#appid_'+id).fadeOut(900,function(){
                            $(this).remove();
                        });
                        Swal.fire(
                            'Deleted successfully',
                            '',
                            'success'
                        );
                    }
                });
            } 
        
        })
    }
</script>
@endpush
