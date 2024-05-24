@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Customer Forms'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Customer Forms</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer Forms</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-60">
                    <a onclick="window.location=document.referrer;" href="javascript:void" class="btn btn_back waves-effect waves-light mt-3"> <i class="uil-angle-left-b"></i> Back</a>
                    </div>
                    <div class="btn_group">
                        <a href="#" onclick="generateForm();" class="btn btn_back waves-effect waves-light">Generate Form</a>
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
                            <table class="table table-centered table-nowrap mb-0" id="customFormTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th >Caretaker Name</th>
                                        <th >Cat Name</th>
                                        <th >Form</th>
                                        <th class="text-center">Signed Status</th>
                                        <!-- <th>Active Status</th> -->
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customFormListing">
                                    @if (isset($custom_forms[0]))
                                        @foreach ($custom_forms as $key=>$cform)
                                        <tr id="appid_{{$cform->id}}">
                                            <td> {{ $key + 1 + ($custom_forms->currentPage() - 1) * $custom_forms->perPage() }} </td>
                                            <td> {{ $cform->caretaker_name }} </td>
                                            <td> {{ $cform->cat_name }} </td>
                                            <td> {{ $cform->form_title }} </td>
                                            <td class="text-center">
                                                @if($cform->signed_status == 1)
                                                    <div class="badge bg-soft-success font-size-12">Signed</div>
                                                @else
                                                    <div class="badge bg-soft-danger font-size-12">Pending</div>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                @if($cform->status == 1)
                                                    <div class="badge bg-soft-success font-size-12">Active</div>
                                                @else
                                                    <div class="badge bg-soft-danger font-size-12">Inactive</div>
                                                @endif
                                            </td> -->
                                            <td> {{ $cform->created_at->format('Y-m-d') }} </td>
                                            <td class="text-center">
                                                <a href="{{ route('custom-form.view',$cform->id) }}" class="px-2 btn btn-app"  title="View form data"><i class="uil uil-eye font-size-18 text-primary"></i>View</a>
                                                <a href="#" class="px-2 btn btn-app" onclick="deleteCustomForm('{{$cform->id}}')" title="Delete form"><i class="uil uil-trash required font-size-18"></i>Delete</a>
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
                                {{ $custom_forms->appends(request()->input())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Add New Event MODAL --> 
        <div class="modal fade bs-example-modal-lg" id="generateNew" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Generate Form Details </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body" id="form_generate">
                            <form id="form_generateForm" method="post" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-form-label">Caretaker<span class="required">*</span></label>
                                        <select class="form-control me-auto select2" class="form-control" id="caretaker_id" name="caretaker_id" style="width:100% !important;">
                                            <option value="" selected>Select Caretaker</option>
                                            @foreach($caretakers as $care)
                                            <option value="{{ $care->id }}">{{ $care->name }} ({{$care->customer_id}}) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-form-label">Cat<span class="required">*</span></label>
                                        <select class="form-control me-auto select2" class="form-control" id="cat_id" name="cat_id" style="width:100% !important;">
                                            <option value="" selected>Select Cat</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-form-label">Form Type<span class="required">*</span></label>
                                        <select class="form-control me-auto select2" class="form-control" id="form_id" name="form_id" style="width:100% !important;" >
                                            <option value="" selected>Select Form Type</option>
                                            @foreach($forms as $form)
                                            <option value="{{ $form->id }}">{{ $form->form_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 text-center mt-3 text-end">
                                        <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Generate"/>
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
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
<style>
    .table>:not(thead)>*>* {
        padding: 0rem 0.75rem !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let catId = {{$cat_id ?? 0}};
    var caretaker_id = {{$caretaker_id ?? 0}};

    window.onload = function() {
    
        if(caretaker_id != 0){
            generateForm();
            $('#caretaker_id').val(caretaker_id).trigger('change');
            
        }
    }


    // getCustomForms();

    $('#caretaker_id').select2({
        dropdownParent: $('#generateNew'),
        width: 'resolve', // need to override the changed default
    });
    $('#cat_id').select2({
        dropdownParent: $('#generateNew'),
        width: 'resolve', // need to override the changed default
    });

    $('#form_id').select2({
        dropdownParent: $('#generateNew'),
        width: 'resolve', // need to override the changed default
    }); 

    function getCustomForms(){
        var search = $('#search').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        $.ajax({
            url: "{{ route('custom-forms-list')}}",
            type: "POST",
            data: { 
                search:search,
                from_date:from_date,
                to_date:to_date
            },
            success: function( response ) {
                $('#customFormTable').DataTable().clear();
                $('#customFormTable').DataTable().destroy();
                $('#customFormListing').html(response);
                $('#customFormTable').DataTable();  
            }
        });
    }

    function deleteCustomForm(id){
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
                    url: "{{ route('custom-form.delete')}}",
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
                        setTimeout(function() {
                                window.location.reload();
                            }, 3000);

                    }
                });
            } 
        
        })
    }

    function generateForm(){
        $('#generateNew').modal('show');
    }

    $("#caretaker_id").on("change", function () { 
        var cid = $(this).val();
        $.ajax({
            url: "{{ route('get-caretaker-cats')}}",
            type: "POST",
            data: 'cid='+ cid,
            success: function( response ) {
                var returnedData = JSON.parse(response);
                var cats_html = '';
                cats_html += '<option value="">Select Cat</option>';
                $.each(returnedData, function(index, value) {
                    cats_html += '<option value="'+value.id+'" >'+value.name + ' ('+ value.cat_id + ')'+'</option>';
                });  

                $('#cat_id').html(cats_html);
                $("#cat_id").trigger('change');
                console.log(catId);
                if(catId != 0){
                    $('#cat_id').val(catId).trigger('change');
                }
            }
        });
    });

    $("#form_generateForm").validate({
        rules: {
            caretaker_id: "required",
            cat_id: "required",
            form_id: "required",
        },
        messages: {
            caretaker_id: " Please select a caretaker",
            cat_id: " Please select cat",
            form_id: " Please select form type",
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2')) {
                error.insertAfter(element.next('.select2-container'));
            }else{
                error.appendTo(element.parent("div"));
            }
        },
        submitHandler: function(e) { 
        
            var data = new FormData($('#form_generateForm')[0]);
            $.ajax({
                url: "{{ route('generate-custom-form')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        'Form generated successfully!',
                        'success'
                    );
                    $("#generateNew").modal('hide');
                    $("#caretaker_id").val('').trigger('change') ;
                    $("#cat_id").val('').trigger('change') ;
                    $("#form_id").val('').trigger('change') ;
                    setTimeout(function() {
                        window.location.href= "{{ route('custom-forms')}}";
                    }, 3000);

                }
            });
        }
    });
</script>
@endpush