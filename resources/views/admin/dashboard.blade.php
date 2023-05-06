@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row data_count">
            <div class="col">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="float-end mt-2">
                            
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countCats }}</span></h4>
                            <p class="text-muted mb-0">No. of Registered Cats</p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="float-end mt-2">
                    
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countCaretaker }}</span></h4>
                            <p class="text-muted mb-0">No. of Registered Caretakers</p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="float-end mt-2">
                        
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countNeutered }}</span></h4>
                            <p class="text-muted mb-0">Total no. of Neutered Cats  </p>
                        </div>
                    
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="float-end mt-2">
                        
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"> {{ $countSpayed }}</span></h4>
                            <p class="text-muted mb-0">Total no. of Spayed Females </p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $countCastrated }}</span></h4>
                            <p class="text-muted mb-0">Total no. of Castrated Males</p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Search Caretaker</h4>
                            <div class="hstack gap-3 " id="searchCaretaker">
                                <select class="form-control me-auto" placeholder="Search by : Reg No, Name, Mobile Number, ED"
                                    aria-label="Add your item here..." name="search_caretaker" id="search_caretaker" style="width: 100%">
                                
                                </select>
                                <!-- <a href="#" class="btn btn-primary waves-effect waves-light w-xl">Search Caretaker</a> -->
                            </div>
                            <a href="{{ route('caretaker.create') }}"
                            class="btn btn-primary waves-effect waves-light w-xl mt-3">Register Caretaker</a>

                    </div><!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Search Cat</h4>
                            <div class="hstack gap-3">
                                <select class="form-control me-auto" placeholder="Search by : Name, Id"
                                    aria-label="Add your item here..." name="search_cat" id="search_cat" style="width: 100%">
                                
                                </select>
                                <!-- <button class="btn btn-primary waves-effect waves-light w-xl">Search Cat</button> -->
                            </div>
                            <a href="{{ route('cat.create') }}"
                            class="btn btn-primary waves-effect waves-light w-xl mt-3">Register Cat</a>

                    </div><!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->



        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-4 align-items-center">
                            <div class="col-6">
                                <h4 class="card-title mb-4">Contact Directory</h4>
                            </div>
                            <div class="col-6">
                                <form>
                                    <div class="hstack gap-3">
                                        <input class="form-control me-auto" type="text" id='search' placeholder="Search by : Name, Phone Number, Email, Address">
                                        <button type="button" class="btn btn-primary waves-effect waves-light w-xl" onclick=" getDasboardCaretakers()">Search</button>
                                        <button type="button" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0" id="caretakerTable">
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th>Sl NO</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Whatsapp Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="caretakerDetails">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getDasboardCaretakers(); 
    $('#caretakerTable').DataTable({searching: false}); 
        
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('#search_caretaker').select2({
        placeholder: 'Search by : Customer ID, Name, Mobile Number, ED',
        dropdownParent: $('#searchCaretaker'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
        ajax: {
            url: '{{ route("dashboard-caretaker-search") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name + ' ['+ item.customer_id + ']',
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    $("#search_caretaker").on("change", function () { 
        var id = $(this).val();
        var url = '{{ route("caretaker.view", ":id") }}';
            url = url.replace(':id', id);
        window.location.href = url;
    });

    $('#search_cat').select2({
        placeholder: 'Search by : Cat Name, Cat ID, Gender, Microchip Number, Fur Color, Eye Color',
        dropdownParent: $('#searchCaretaker'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
        ajax: {
            url: '{{ route("dashboard-cat-search") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name + ' ['+ item.cat_id + ']',
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $("#search_cat").on("change", function () { 
        var id = $(this).val();
        var url = '{{ route("cat.view", ":id") }}';
            url = url.replace(':id', id);
        window.location.href = url;
    });

    function getDasboardCaretakers(){
        var search = $('#search').val();
        $.ajax({
            url: "{{ route('dashboard-caretaker-list')}}",
            type: "POST",
            data: { 
                search:search
            },
            success: function( response ) {
            $('#caretakerDetails').html(response);
            $('#caretakerTable').DataTable();  
            }
        });
    }
    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getDasboardCaretakers(); 
    });
</script>
@endpush