@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hospital Appointments'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Invoice Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Invoice Detail</li>
                            </ol>
                        </div>
                    </div>
                  
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        @if($invoice[0]->booking_type == 'hospital_appointment')
                            <a href="{{ route('manage-hospital-appointments') }}" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
                        @else
                            <a href="{{ route('manage-hotel-bookings') }}" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
                        @endif
                       
                        <div class="btn_group">
                            <a href="#" class="btn btn_back waves-effect waves-light me-2" onclick="editInvoice('{{$invoice[0]->booking_type}}',{{$invoice[0]->id}});"> Update Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16">Invoice #INV{{$invoice[0]->id}} 
                                    @if($invoice[0]->payment_confirmation == 1)
                                        <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                    @else
                                        <span class="badge bg-danger font-size-12 ms-2">Not Paid</span>
                                    @endif
                                </h4>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-15 mb-2">{{$invoice[0]->caretaker_name}}</h5>
                                        <p class="mb-1">{{$invoice[0]->address}}</p>
                                        <p class="mb-1">{{$invoice[0]->email}}</p>
                                        <p>{{$invoice[0]->phone_number}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                            <p>#INV{{$invoice[0]->id}}</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                            <p>{{$invoice[0]->invoice_date}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="py-2">
                                <h5 class="font-size-15">Summary</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Ptld</th>
                                                <th>Service</th>
                                                <th>Price</th>
                                                <th>Net</th>
                                                <th>VAT</th>
                                                <th>Net+Vat</th>
                                                <th>Service Charge</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">01</th>
                                                <td>{{$invoice[0]->cat_id}} </td>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{$invoice[0]->service}}</h5>
                                                </td>
                                                <td>{{$invoice[0]->price}}</td>
                                                <td>{{$invoice[0]->net}}</td>
                                                <td>{{$invoice[0]->vat}}</td>
                                                <td>{{$invoice[0]->net_vat}}</td>
                                                <td>{{$invoice[0]->service_charge}}</td>

                                                <td class="text-end">{{$invoice[0]->total}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="8" class="text-end">Sub Total :</th>
                                                <td class="text-end">{{$invoice[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end">
                                                    Net :</th>
                                                <td class="border-0 text-end">{{$invoice[0]->net}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end">
                                                    VAT :</th>
                                                <td class="border-0 text-end">{{$invoice[0]->vat}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end">
                                                    Service Amount :</th>
                                                <td class="border-0 text-end">{{$invoice[0]->service_charge}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end">
                                                    Net +VAT+Service Amount :</th>
                                                <td class="border-0 text-end">{{$invoice[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end">Total :</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0">{{$invoice[0]->total}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                    </div>
                                    <div class="float-end">
                                        <a href="{{ route('generate-pdf',['id' => $invoice[0]->id, 'type' => $invoice[0]->booking_type])}}" target="_blank" class="btn btn-danger waves-effect waves-light me-1">Generate Pdf <i class="fa fa-file-pdf"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

             <!-- Add New Event MODAL --> 
            <div class="modal fade bs-example-modal-lg" id="updateInvoice" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Update Invoice Details </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body" id="appointment_details">
                            <form id="invoiceUpdate" method="post" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="form-control" type="hidden"  id="invoice_id" name="invoice_id" value="{{$invoice[0]->id}}"  >
                                        <input class="form-control" type="hidden"  id="total" name="total" value="{{$invoice[0]->total}}">
                                        <label class="col-form-label">Price</label>
                                        <input class="form-control" type="text"  id="price" name="price" value="{{$invoice[0]->price}}"  placeholder="Price">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Net</label>
                                        <input class="form-control" type="text"  id="net" name="net" value="{{$invoice[0]->net}}" placeholder="Net">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">VAT</label>
                                        <input class="form-control" type="text"  id="vat" name="vat" value="{{$invoice[0]->vat}}" placeholder="VAT">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Net + VAT</label>
                                        <input class="form-control" type="text"  id="net_vat" name="net_vat" value="{{$invoice[0]->net_vat}}" placeholder="Net + VAT">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Service Charge</label>
                                        <input class="form-control" type="text"  id="service_charge" name="service_charge" value="{{$invoice[0]->service_charge}}" placeholder="Service Charge">
                                    </div>
            

                                    <div class="col-md-12 text-center mt-3 text-end">
                                        <input type="submit" class="btn btn-primary waves-effect waves-light w-xl me-2" id="create_appoinment" value="Update Invoice"/>
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

    function editInvoice(type,id){
        $('#updateInvoice').modal('show');
    }

    $('#price').on('input', function() {
        var price = parseInt($(this).val());
        var vat = parseInt($('#vat').val());
        var service = parseInt($('#service_charge').val());

        $('#net_vat').val(price+vat);
        $('#net').val(price);
        $('#total').val(price+vat+service);
    });

    $('#vat').on('input', function() {
        var vat = parseInt($(this).val());
        var net = parseInt($('#net').val());
        var service = parseInt($('#service_charge').val());

        $('#net_vat').val(net+vat);
        $('#total').val(net+vat+service);
    });

    $('#net').on('input', function() {
        var net = parseInt($(this).val());
        var vat = parseInt($('#vat').val());
        var service = parseInt($('#service_charge').val());

        $('#net_vat').val(net+vat);
        $('#total').val(net+vat+service);
    });

    $('#service_charge').on('input', function() {
        var service = parseInt($(this).val());
        var net_vat = parseInt($('#net_vat').val());

        $('#total').val(net_vat+service);
    });


    $("#invoiceUpdate").validate({
        rules: {
            price: "required",
        },
        messages: {
            price: "Please enter price"
        },
        submitHandler: function(e) { 
            var data = new FormData($('#invoiceUpdate')[0]);
            $.ajax({
                url: "{{ route('update-invoice-data')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        'Invoice updated successfully!',
                        'success'
                    );
                    
                    setTimeout(function(){
                        $("#updateInvoice").modal('hide');
                        window.location.reload();
                    }, 2000);
                }
            });
        }
    });
</script>
@endpush