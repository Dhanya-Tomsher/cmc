@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hotel Bookings'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Manage Hotel Bookings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Hotel Bookings</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-60">
                        <form>
                            <div class="hstack gap-2">
                                <input class="form-control me-auto border-0" type="text" id="search" placeholder="Search with Room Number, Caretaker and Cat ">
                                <button type="button" class="btn btn_back waves-effect waves-light w-md" id="bookingSearch" onclick="getBookings()">Search</button>
                                <button type="button" class="btn btn_back waves-effect waves-light w-md" id="bookingReset">Reset</button>
                            </div>
                        </form>
                    </div>

                    <div class="btn_group">
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                            <input type="text" class="form-control text-start" placeholder="From" name="From" id="from_date">
                            <input type="text" class="form-control text-start" placeholder="To" name="To" id="to_date">
                            <button type="button" class="btn btn-primary" id="dateFilter" onclick="getBookings()"><i  class="fa fa-search"></i></button>
                            <button type="button" class="btn btn-primary" id="resetDateFilter" ><i  class="fa fa-sync"></i></button>
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
                            <table class="table table-centered table-nowrap mb-0" id="hotelBookings">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Room Number</th>
                                        <th>Caretaker Name</th>
                                        <th>Caretaker ID</th>
                                        <th>Cat Name</th>
                                        <th>Cat ID</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="bookingDetails">
                                    <tr>
                                        <td colspan="10" class="text-center"> No data available</td>
                                    </tr>
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
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getBookings(); 

    function getBookings(){
        var search = $('#search').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        $.ajax({
            url: "{{ route('booking.list')}}",
            type: "POST",
            data: { 
                search:search,
                from_date:from_date,
                to_date:to_date
            },
            success: function( response ) {
                
                $('#bookingDetails').html(response);
                $('#hotelBookings').DataTable();  
            }
        });
    }
    function deleteBooking(id){
        var el = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this booking details?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = []
                alert();
                $.ajax({
                    url: "{{ route('booking.delete')}}",
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
   
    $("#bookingReset").on("click", function (e) { 
        $('#search').val('');
        getBookings(); 
    });
    $("#resetDateFilter").on("click", function (e) { 
        $('#from_date,#to_date' ).datepicker( 'setDate', '' ).datepicker('fill');
        getBookings(); 
    });
</script>
@endpush