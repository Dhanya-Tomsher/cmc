@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hospital Appointments'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">@if($type == 'hospital') Hospital @else Hotel @endif Invoice Detail</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">@if($type == 'hospital') Hospital @else Hotel @endif Invoice Detail</li>
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
                        <div class="card-body" id="print-area">
                            <div class="col-md-12 text-center" style="">
                                <img src="{{asset('assets/images/logo.png') }}" style="width:200px;">
                                    <br>
                                <span> Cats Medical Center Veterinary Clinic L.L.C. </span><br>
                                <span><i class="fa fa-map-marker-alt"></i>  Al Murooj complex, downtown Dubai, UAE.</span><br>
                                <span>  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204, <i class="fab fa-whatsapp" style="color: green"></i> 04 320 4204</span>
                                <br><span>TRN: 100527270100003 </span>
                            </div>

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
                                    <div class="text-muted float-end">
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
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Ptld</th>
                                                <th>@if($type == 'hospital') Service @else Room @endif</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Net</th>
                                                <th class="text-center">VAT</th>
                                                <th class="text-center">Net+Vat</th>
                                                <th class="text-center">Service Charge</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">01</th>
                                                <td>{{$invoice[0]->cat_ids}} </td>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{$invoice[0]->service}}</h5>
                                                </td>
                                                <td class="text-center">{{$invoice[0]->price}}</td>
                                                <td class="text-center">{{$invoice[0]->net}}</td>
                                                <td class="text-center">{{$invoice[0]->vat}}</td>
                                                <td class="text-center">{{$invoice[0]->net_vat}}</td>
                                                <td class="text-center">{{$invoice[0]->service_charge}}</td>

                                                <td class="text-end">{{$invoice[0]->total}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="8" class="text-end padding-invoice">Sub Total :</th>
                                                <td class="text-end padding-invoice">{{$invoice[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end padding-invoice">
                                                    Net :</th>
                                                <td class="border-0 text-end padding-invoice">{{$invoice[0]->net}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end padding-invoice">
                                                    VAT :</th>
                                                <td class="border-0 text-end padding-invoice">{{$invoice[0]->vat}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end padding-invoice">
                                                    Service Amount :</th>
                                                <td class="border-0 text-end padding-invoice">{{$invoice[0]->service_charge}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end padding-invoice">
                                                    Net +VAT+Service Amount :</th>
                                                <td class="border-0 text-end padding-invoice">{{$invoice[0]->total}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-end padding-invoice">Total :</th>
                                                <td class="border-0 text-end padding-invoice">
                                                    <h4 class="m-0"><span style="font-size:18px;margin-top:2px;">AED &nbsp;</span>{{$invoice[0]->total}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="#" onclick="printElement(`print-area`)" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
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
                                        <input class="form-control" readonly type="text"  id="net_vat" name="net_vat" value="{{$invoice[0]->net_vat}}" placeholder="Net + VAT">
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
<style>
     #print-area{
        padding-left: 25px;
        padding-right: 25px;
    }
    @media print {
        #header{display:none;}
        #footer{display:none;}
        @page { 
            padding: 4% !important; 
        }
        .invoice-title{
            display : none;
         }
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

    function printElement(elem)
    {
        var  node = document.getElementById("print-area");
        var domClone = node.cloneNode(true);

        var $printSection = document.getElementById("print-area-new");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "print-area-new";
            document.body.appendChild($printSection);
        }
  
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
        $printSection.innerHTML = "";
    }

    function editInvoice(type,id){
        $('#updateInvoice').modal('show');
    }

    $('#price').on('input', function() {
        var price = parseFloat($(this).val());
    
        var service = parseFloat($('#service_charge').val());
        service = service ? service :0;

        price = (price) ? price : 0
        var newVat = (price != 0) ? (price/100)*5 : 0;

        var net_vat = price+newVat;
        net_vat = (net_vat) ? net_vat : 0;

        var total = price+newVat+service;
        total = (total) ? total :0;

        $('#net_vat').val(net_vat);
        $('#net').val(price);
        $('#vat').val(newVat);
        $('#total').val(total);
    });

    $('#net').on('input', function() {
        var net = parseFloat($(this).val());
        var service = parseFloat($('#service_charge').val());
        service = service ? service :0;
        
        net = (net) ? net : 0
        var newVat = (net != 0) ? (net/100)*5 : 0;

        var net_vat = net+newVat;
        net_vat = (net_vat) ? net_vat : 0;

        var total = net+newVat+service;
        total = (total) ? total :0;
        
        $('#vat').val(newVat);
        $('#net_vat').val(net_vat);
        $('#total').val(total);
    });

    $('#vat').on('input', function() {
        var vat = parseFloat($(this).val());
        var net = parseFloat($('#net').val());
        var service = parseFloat($('#service_charge').val());
        service = service ? service :0;
        var net_vat = net+vat;
        net_vat = (net_vat) ? net_vat : 0;

        var total = net+vat+service;
        total = (total) ? total :0;

        $('#net_vat').val(net_vat);
        $('#total').val(total);
    });

    

    $('#service_charge').on('input', function() {
        var service = parseFloat($(this).val());
        var net_vat = parseFloat($('#net_vat').val());
        service = service ? service :0;
        var total = net_vat+service;
        total = (total) ? total :0;

        $('#total').val(total);
    });


    $("#invoiceUpdate").validate({
        rules: {
            price: "required",
            vat: "required",
            net_vat: "required",
            net: "required",
        },
        messages: {
            
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