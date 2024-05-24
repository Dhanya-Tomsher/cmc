@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Cats'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Cats</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Cats</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-50">
                        <form action="">
                            <div class="hstack gap-2">
                                <input class="form-control me-auto border-0" type="text" id='search' placeholder="Search here" name="search" value="{{ $search }}">
                                <button type="submit" class="btn btn_back waves-effect waves-light w-xl" >Search</button>
                                <a href="{{ route('cat.index') }}" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</a>
                            </div>
                        </form>
                    </div>

                    <!-- <div class="btn_group">
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                            <input type="text" class="form-control text-start" placeholder="From" name="From">
                            <input type="text" class="form-control text-start" placeholder="To" name="To">
                            <button type="button" class="btn btn-primary"><i
                                    class="mdi mdi-filter-variant"></i></button>
                        </div>
                    </div> -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('cat.create') }}" class="btn btn_back waves-effect waves-light w-xl" id="new_appointment">Create Cat</a>
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
                            <table class="table table-centered table-nowrap mb-0" id="catsTables">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Cat Name</th>
                                        <th class="text-center">Cat Image</th>
                                        <th class="text-center">Cat ID</th>
                                        <th>Caretaker</th>
                                        <th class="text-center">Gender</th>
                                        <!-- <th>Status</th> -->
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="catDetails">
                                    @if(isset($cats[0]))
                                        @foreach ($cats as $key => $cate)
                                        
                                            <tr>
                                                <td>{{ $key + 1 + ($cats->currentPage() - 1) * $cats->perPage() }} </td>
                                                <td>{{ $cate->cat_name }} </td>
                                                <td class="text-center">
                                                    @if($cate->image_url == NULL)
                                                        <a href="{{ route('cat.view', $cate) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset('assets/images/cat_plc.jpg') }} " data-holder-rendered="true"> </a>
                                                    @else
                                                        <a href="{{ route('cat.view', $cate) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset($cate->image_url) }} " data-holder-rendered="true"> </a>
                                                    @endif
                                                    
                                                </td>
                                                <td class="text-center">{{ $cate->cat_id }} </td>
                                                <td>{{ $cate->caretaker_name }} </td>
                                                <td class="text-center">{{ $cate->gender }} </td>
                                                <!-- <td>
                                                    @if($cate->status == 'published')
                                                        <div class="badge bg-soft-success font-size-12">{{ $cate->status }}</div>
                                                    @else
                                                        <div class="badge bg-soft-danger font-size-12">{{ $cate->status }}</div>
                                                    @endif
                                                </td> -->
                                                <td class="text-center">
                                                    <a href="{{ route('cat.view', $cate) }}" class="px-1 btn btn-app"><i  class="uil uil-eye font-size-18 text-primary"></i>View</a>

                                                    <a href="{{ route('cat.edit', $cate) }}" class="px-1 btn btn-app"><i class="uil uil-pen green font-size-18"></i>Edit</a>
                                                    <!-- <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a> -->

                                                    <a href="{{ route('custom-forms', $cate->id) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" data-bs-title="Forms" class="px-1 btn btn-app"><i class="uil uil-file-alt font-size-18 text-pink" ></i>Forms</a>

                                                   
                                                    <div class="tooltipp">
                                                        <a href="#" class="px-1 btn btn-app"><i class="uil uil-invoice font-size-18 text-purple"></i>Invoice</a>
                                                        <div class="tooltiptext">
                                                            <a href="{{route('invoice.create', $cate->cat_name)}}" class="btn btnn" >Custom</a>
                                                            <a href="{{route('dynamic-invoice.create', $cate->cat_name)}}" class="btn btnn" >Dynamic</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="atbd-empty__image">
            
                                                    <img src="{{ asset('assets/images/1.svg')}}" alt="Admin Empty">
            
                                                </div>
                                                No data found.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination mt-3">
                                {{ $cats->appends(request()->input())->links('pagination::bootstrap-5') }}
                            </div>
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

<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
<style>
/* Tooltip container */
.tooltipp {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* Tooltip text */
    .tooltipp .tooltiptext {
        visibility: hidden;
        width: auto;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        top: -50%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    /* Show the tooltip text when hovering over the tooltip container */
    .tooltipp:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }

    /* Style the buttons */
    .tooltipp .btnn {
        background-color: #faf39f;
        color: black;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        border-radius: 3px;
        margin: 2px;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // getCats(); 

    function getCats(){
        var search = $('#search').val();
        $.ajax({
            url: "{{ route('cat.list')}}",
            type: "POST",
            data: { 
                search:search
            },
            success: function( response ) {
                $('#catsTable').DataTable().clear();
                $('#catsTable').DataTable().destroy();
                $('#catDetails').html(response);
                $('#catsTable').DataTable();  
            }
        });
    }

    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getCats(); 
    });
</script>
@endpush