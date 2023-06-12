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
                        
                        <a href="{{ route('invoice.index') }}" class="btn btn_back waves-effect waves-light">  <i class="uil-angle-left-b"></i> Back</a>
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
                                <span><i class="fa fa-map-marker-alt">  Al Murooj complex, downtown Dubai, UAE.</i></span><br>
                                <span>  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204, <i class="fab fa-whatsapp" style="color: green"></i> 04 320 4204</span>
                            </div>
                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6" style="margin: auto;">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-1">Cat Name: {{$invoice[0]->cat_name}}</h5>
                                        <p></p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted float-end">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                            <p>#CINV{{$invoice[0]->id}}</p>
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
                                                <th class="w-30">Service</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Net</th>
                                                <th class="text-center">VAT</th>
                                                <th class="text-center">Net+Vat</th>
                                                <th class="text-center">Service Charge</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoice[0]->custom_invoice_details as $invDet)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{$invDet->procedure}}</h5>
                                                </td>
                                                <td class="text-center">{{$invDet->quantity}}</td>
                                                <td class="text-center">{{$invDet->unit_price}}</td>
                                                <td class="text-center">{{$invDet->net}}</td>
                                                <td class="text-center">{{$invDet->vat}}</td>
                                                <td class="text-center">{{$invDet->net_vat}}</td>
                                                <td class="text-center">{{$invDet->service_charge}}</td>

                                                <td class="text-end">{{$invDet->total}}</td>
                                            </tr>

                                            @endforeach
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
                                                    <h4 class="m-0">{{$invoice[0]->total}}</h4>
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
                                        <a href="{{ route('generate-custom-pdf',['id' => $invoice[0]->id])}}" target="_blank" class="btn btn-danger waves-effect waves-light me-1">Generate Pdf <i class="fa fa-file-pdf"></i></a>
                                    </div>
                                </div>
                            </div>
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
<style>
    @media print {
         @page { margin: 4% !important; }
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

</script>
@endpush