@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hotel Bookings'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Forms</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Forms</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-60">
                    </div>
                    <div class="btn_group">
                        <a href="{{ route('form.create') }}"   class="btn btn_back waves-effect waves-light">Create New Form</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th class="w-50">Form Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                    <tr id="appid_{{$form->id}}">
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $form->form_title }} </td>
                                        <td>
                                            @if($form->status == 1)
                                                <div class="badge bg-soft-success font-size-12">Enabled</div>
                                            @else
                                                <div class="badge bg-soft-danger font-size-12">Disabled</div>
                                            @endif
                                        </td>
                                        <td> {{ $form->created_at->format('Y-m-d') }} </td>
                                        <td class="text-center">
                                            <a href="{{ route('form.view',$form) }}" class="px-2 btn btn-app"  title="View form data"><i class="uil uil-eye font-size-18 text-primary"></i>View</a>
                                            <a href="{{ route('form.edit',$form) }}" class="px-2 btn btn-app"  title="Edit form data"><i class="uil uil-pen green font-size-18"></i>Edit</a>
                                            <a href="#" class="px-2 btn btn-app" onclick="deleteForm('{{$form->id}}')" title="Delete form"><i class="uil uil-trash required font-size-18"></i>Delete</a>
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
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection
@push('header')

@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteForm(id){
        var el = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this form?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
        
            if (result.isConfirmed) {
                var data = [];
                $.ajax({
                    url: "{{ route('form.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
                        console.log('#appid_'+id);
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