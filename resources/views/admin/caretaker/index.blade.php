@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
@section('content')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Caretaker</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Caretaker</li>
                                        </ol>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <div class="search_warpper w-50">
                                       <form>
                                       <div class="hstack gap-2">
                                            <input class="form-control me-auto border-0" type="text" id='search' placeholder="Search here">
                                            <button type="button" class="btn btn_back waves-effect waves-light w-xl" onclick=" getCaretakers()">Search</button>
                                            <button type="button" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</button>
                                        </div>
                                       </form>
                                    </div>

                                    <!-- <div class="btn_group">
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                            <input type="text" class="form-control text-start" placeholder="From" name="From">
                                            <input type="text" class="form-control text-start" placeholder="To" name="To">
                                            <button type="button" class="btn btn-primary"><i class="mdi mdi-filter-variant"></i></button>
                                        </div>
                                    </div> -->
                                    <div  class="btn_group">
                                        <!-- <div class="d-flex justify-content-end mb-3"> -->
                                            <a href="{{ route('caretaker.create') }}" class="btn btn_back waves-effect waves-light w-xl" id="new_appointment">Create Caretaker</a>
                                        <!-- </div>
                                        <div class="d-flex justify-content-end mb-3"> -->
                                            <a href="{{ route('caretaker.blacklisted') }}" class="btn btn_back waves-effect waves-light w-xl" id="blacklisted">Blacklisted Caretakers</a>
                                        <!-- </div> -->
                                    </div>
                               </div>


                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if(session()->has('status'))
                                            <div class="alert alert-success">
                                                {{ session()->get('status') }}
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0" id="caretakerTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Customer ID</th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Whatsapp</th>
                                                        <!-- <th>Status</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="caretakerDetails">
                                                    
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
    getCaretakers(); 

    function getCaretakers(){
        var search = $('#search').val();
        $.ajax({
            url: "{{ route('caretaker.list')}}",
            type: "POST",
            data: { 
                search:search
            },
            success: function( response ) {
                $('#caretakerTable').DataTable().clear();
                $('#caretakerTable').DataTable().destroy();
                $('#caretakerDetails').html(response);
                $('#caretakerTable').DataTable();  
            }
        });
    }

    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getCaretakers(); 
    });
</script>
@endpush