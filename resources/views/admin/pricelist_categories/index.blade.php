@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Price List Categories'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Price List Categories</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Price List Categories</li>
                            </ol>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-70">
                            <form action="" autocomplete="off">
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="text" id='search'
                                        value="{{ $search }}" name="name" placeholder="Search here">

                                    <select class="form-control form-select" name="status_filter" value="" id="status_filter">
                                        <option value="">Filter with status </option>
                                        <option {{ ($status == 1) ? 'selected' : '' }} value="1">Enabled</option>
                                        <option {{ ($status == 2) ? 'selected' : '' }} value="2">Disabled</option>
                                    </select>

                                    <button type="submit"
                                        class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                    <a href="{{ route('pricelist-categories.index') }}"
                                        class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</a>
                                </div>
                            </form>
                        </div>

                        <div class="btn_group">
                            <div class="input-daterange input-group">
                                <a href="#" class="btn btn-primary" onclick="createCategory();">Create New
                                    Category</a>
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
                                @if (session()->has('status'))
                                    <div class="alert alert-success">
                                        {{ session()->get('status') }}
                                    </div>
                                @endif
                                <table class="table table-centered mb-0" id="serviceTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="w-40">Category Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="serviceDetails">
                                        @if (isset($category[0]))
                                            @foreach ($category as $key=>$cat)
                                                <tr id="proid_{{ $cat->id }}">
                                                    <td class="text-center">{{ $key + 1 + ($category->currentPage() - 1) * $category->perPage() }} </td>
                                                    <td>
                                                        <a href="{{ route('services',['id' => $cat->id]) }}">{{ $cat->name }} </a>
                                                        
                                                    </td>
                                                   
                                                    <td class="text-center">
                                                        @if ($cat->is_active == 1)
                                                            <div class="badge bg-soft-success font-size-12">Enabled</div>
                                                        @else
                                                            <div class="badge bg-soft-danger font-size-12">Disabled</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="px-2 btn btn-app"
                                                            onclick="editCategory({{ $cat }});"><i
                                                                class="uil uil-pen green font-size-18 text-primary"></i>Edit</a>
                                                        {{-- <a href="#" onclick="deleteProdcedure('{{ $cat->id }}');"
                                                            class="px-2 btn btn-app"><i
                                                                class="uil uil-trash required font-size-18"></i>Delete</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">
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
                                    {{ $category->appends(request()->input())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- Add New Event MODAL -->
            <div class="modal fade bs-example-modal-md" id="createCategory" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Create New Category </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="frm" action="{{ route('pricelist-categories.store') }}" id="createForm" enctype="multipart/form-data" method="POST" autocomplete="off">

                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Name" class="col-form-label">Category<span
                                                class="required">*</span></label>
                                        <input class="form-control" name="category" value="" type="text"
                                            placeholder="Enter Category Name" id="category">
                                        <input type="hidden" name="cat_id" id="cat_id" value=''>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="country" class="col-form-label">Status</label>
                                        <select class="form-select form-control" name="pstatus" id="pstatus">
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 align-self-end mt-3 text-center">
                                        <div class="">
                                            <input class="form-control" name="action_type" type="hidden" id="action_type">
                                            <button name="Submit" type="submit" id="saveService"
                                                class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div> <!-- end modal dialog-->
            </div>
            <!-- end modal-->

        </div> <!-- container-fluid -->
    </div>
@endsection
@push('header')
    <style>
        .table>:not(thead)>*>* {
            padding: 0rem 0.75rem !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        function createCategory() {
            $('#createForm')[0].reset();
            $('.error').html('');
            $('#myExtraLargeModalLabel').html('Create New Category');
            $('#category').removeClass('error');
            $('#price').removeClass('error');
            $('#cat_id').val('');
            $('#action_type').val('create');
            $('#createCategory').modal('show');
        }
        // $("#searchReset").on("click", function (e) { 
        //     $('#search').val('');
        //     getServices(); 
        // });

        $("#createForm").validate({
            rules: {
                category: "required",
                price: "required"
            },
            messages: {
                category: "Please enter a category",
                price: "Please enter price"
            },
            submitHandler: function(e) {
                var data = new FormData($('#createForm')[0]);
                var action = $('#action_type').val();
                
                $.ajax({
                    url: "{{ route('pricelist-categories.store') }}",
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire(
                            '',
                            response,
                            'success'
                        );
                        $("#createCategory").modal('hide');
                        $('#createForm')[0].reset();
                        setTimeout(function() {
                            if(action == 'create'){
                                window.location.href="{{ route('pricelist-categories.index') }}";
                            }else{
                                window.location.reload();
                            }
                        }, 3000);
                    }
                });
            }
        });

        function editCategory(category) {
            $('#createForm')[0].reset();
            $('.error').html('');
            $('#category').removeClass('error');
            $('#price').removeClass('error');
            $('#myExtraLargeModalLabel').html('Edit Category Details');

            $('#cat_id').val(category.id);
            $('#category').val(category.name);
            $('#pstatus').val(category.is_active);
            $('#action_type').val('edit');
            $('#createCategory').modal('show');
        }

      
    </script>
@endpush
