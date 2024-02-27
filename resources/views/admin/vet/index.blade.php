@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Vets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Vets</li>
                            </ol>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-50">
                            <form>
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="text" id='search' placeholder="Search here">
                                    <button type="button" class="btn btn_back waves-effect waves-light w-xl" onclick=" getVets()">Search</button>
                                    <button type="button" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="btn_group">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('vet.create') }}"
                                    class="btn btn_back waves-effect waves-light w-md">Create Vet</a>
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
                                <table class="table table-centered table-nowrap mb-0" id="vatTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp</th>
                                            <!-- <th>Status</th> -->
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vetDetails">
                                       
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
    getVets(); 

    function getVets(){
        var search = $('#search').val();
        $.ajax({
            url: "{{ route('vet.list')}}",
            type: "POST",
            data: { 
                search:search
            },
            success: function( response ) {
                $('#vatTable').DataTable().clear();
                $('#vatTable').DataTable().destroy();
                $('#vetDetails').html(response);
                $('#vatTable').DataTable();  
            }
        });
    }

    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getVets(); 
    });
</script>
@endpush