@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Services'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Services</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Services</li>
                            </ol>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-50">
                            <form action="" autocomplete="off">
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="text" id='search'
                                        value="{{ $search }}" name="name" placeholder="Search here">

                                    <button type="submit"
                                        class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                    <a href="{{ route('service.index') }}"
                                        class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</a>
                                </div>
                            </form>
                        </div>

                        <div class="btn_group">
                            <div class="input-daterange input-group">
                                <a href="#" class="btn btn-primary" onclick="createService();">Create New
                                    Service</a>
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
                                <table class="table table-centered table-nowrap mb-0" id="serviceTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Service</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="serviceDetails">
                                        @if (isset($service[0]))
                                            @foreach ($service as $key=>$pro)
                                                <tr id="proid_{{ $pro->id }}">
                                                    <td class="text-center">{{ $key + 1 + ($service->currentPage() - 1) * $service->perPage() }} </td>
                                                    <td>{{ $pro->name }} </td>
                                                    <td class="text-center">{{ $pro->price }} </td>
                                                    <td class="text-center">
                                                        @if ($pro->status == 1)
                                                            <div class="badge bg-soft-success font-size-12">Enabled</div>
                                                        @else
                                                            <div class="badge bg-soft-danger font-size-12">Disabled</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="px-2 btn btn-app"
                                                            onclick="editProdcedure({{ $pro }});"><i
                                                                class="uil uil-pen green font-size-18 text-primary"></i>Edit</a>
                                                        {{-- <a href="#" onclick="deleteProdcedure('{{ $pro->id }}');"
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
                                    {{ $service->appends(request()->input())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- Add New Event MODAL -->
            <div class="modal fade bs-example-modal-md" id="createService" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Create New Service </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="frm" action="{{ route('hrooms.store') }}" id="createForm" enctype="multipart/form-data" method="POST" autocomplete="off">

                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Name" class="col-form-label">Service<span
                                                class="required">*</span></label>
                                        <input class="form-control" name="service" value="" type="text"
                                            placeholder="Enter Service" id="service">
                                        <input type="hidden" name="pro_id" id="pro_id" value=''>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email" class="col-form-label">Price<span
                                            class="required">*</span></label>
                                        <input class="form-control" name="price" type="text" value=""
                                            placeholder="Enter Price" id="price">
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
       
        function createService() {
            $('#createForm')[0].reset();
            $('.error').html('');
            $('#service').removeClass('error');
            $('#price').removeClass('error');
            $('#pro_id').val('');
            $('#action_type').val('create');
            $('#createService').modal('show');
        }
        // $("#searchReset").on("click", function (e) { 
        //     $('#search').val('');
        //     getServices(); 
        // });

        $("#createForm").validate({
            rules: {
                service: "required",
                price: "required"
            },
            messages: {
                service: "Please enter a service",
                price: "Please enter price"
            },
            submitHandler: function(e) {
                var data = new FormData($('#createForm')[0]);
                var action = $('#action_type').val();
                
                $.ajax({
                    url: "{{ route('service.store') }}",
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
                        $("#createService").modal('hide');
                        $('#createForm')[0].reset();
                        setTimeout(function() {
                            if(action == 'create'){
                                window.location.href="{{ route('service.index') }}";
                            }else{
                                window.location.reload();
                            }
                        }, 3000);
                    }
                });
            }
        });

        function editProdcedure(service) {
            $('#createForm')[0].reset();
            $('.error').html('');
            $('#service').removeClass('error');
            $('#price').removeClass('error');

            $('#pro_id').val(service.id);
            $('#service').val(service.name);
            $('#price').val(service.price);
            $('#pstatus').val(service.status);
            $('#action_type').val('edit');
            $('#createService').modal('show');
        }

      
    </script>
@endpush
