@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Rooms'])
@section('content') 
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Rooms</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rooms</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-50">
                        <form>
                            <div class="hstack gap-2">
                                <input class="form-control me-auto border-0" type="text" id='search' placeholder="Search here">
                                <button type="button" class="btn btn_back waves-effect waves-light w-xl" onclick=" getRooms()">Search</button>
                                <button type="button" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</button>
                            </div>
                        </form>
                    </div>

                <div class="btn_group">
                    <div class="input-daterange input-group">
                        <a href="{{route('hrooms.create')}}" class="btn btn-primary">Create New Room</a>
                    </div>
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
                            @if(session()->has('status'))
                                <div class="alert alert-success">
                                    {{ session()->get('status') }}
                                </div>
                            @endif
                            <table class="table table-centered table-nowrap mb-0" id="roomTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Room Number</th>
                                        <th>Type</th>
                                        <th>Branch</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="roomDetails">
                               
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
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
@endpush
@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getRooms(); 

    function getRooms(){
        var search = $('#search').val();
        $.ajax({
            url: "{{ route('rooms.list')}}",
            type: "POST",
            data: { 
                search:search
            },
            success: function( response ) {
                $('#roomTable').DataTable().clear();
                $('#roomTable').DataTable().destroy();
                $('#roomDetails').html(response);
                $('#roomTable').DataTable();  
            }
        });
    }

    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getRooms(); 
    });

    function deleteRoom(room_id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this Room?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            if (result.isConfirmed) {
                var data = []
                
                $.ajax({
                    url: "{{ route('hrooms.delete')}}",
                    type: "POST",
                    data: { room_id:room_id },
                    success: function( response ) {
                        var result = JSON.parse(response);
                        if(result.status == 1){
                            $('#roomid_'+room_id).css('background','#f9a8a8');
                            $('#roomid_'+room_id).fadeOut(900,function(){
                                $(this).remove();
                            });
                            Swal.fire(
                                'Deleted successfully',
                                '',
                                'success'
                            );
                        }else{
                            Swal.fire(
                                '',
                                result.msg,
                                'error'
                            );
                        }
                        
                    }
                });
            } 
            
        })
    }
</script>
@endpush