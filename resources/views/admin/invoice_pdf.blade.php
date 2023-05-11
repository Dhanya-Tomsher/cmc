
<style>
.text-left{
        text-align: left!important;
    }
    .text-right{
        text-align: right!important;
    }
    .border-0{
        border: 0!important;
    }
    .mb-0 {
        margin-bottom: 0!important;
    }

    .table>thead {
        vertical-align: bottom;
    }
    .table-centered th {
        vertical-align: middle!important;
    }
    .table-nowrap th {
        white-space: nowrap;
    }
    .table th {
        font-weight: 600;
    }
    .border{
        border: 1px solid #c3bcbc !important;
    }
</style> 
   

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16">Invoice #INV{{$id }}
                                    @if($payment_confirmation == 1)
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
                                        <h5 class="font-size-15 mb-2">{{ $caretaker_name }}</h5>
                                        <p class="mb-1">{{ $address }}</p>
                                        <p class="mb-1">{{ $email  }}</p>
                                        <p>{{ $phone_number  }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                            <p>#INV{{$id }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                            <p>{{$invoice_date }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="py-2">
                                <h5 class="font-size-15">Summary</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-left" style="width:40px;">No.</th>
                                                <th class="text-left" style="width:50px;" >Ptld</th>
                                                <th class="text-left" style="width:200px;" >Service</th>
                                                <th class="text-left" style="width:50px;" >Price</th>
                                                <th class="text-left" style="width:50px;" >Net</th>
                                                <th class="text-left" style="width:50px;" >VAT</th>
                                                <th class="text-left" style="width:70px;" >Net+Vat</th>
                                                <th class="text-left" style="width:60px;" >Service Charge</th>
                                                <th class="text-right" style="width:50px;" >Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left"> 01</th>
                                                <td class="text-left"> {{$cat_id }} </td>
                                                <td class="text-left"> {{$service }}  </td>
                                                <td class="text-left"> {{$price }}</td>
                                                <td class="text-left"> {{$net }}</td>
                                                <td class="text-left"> {{$vat }}</td>
                                                <td class="text-left"> {{$net_vat }}</td>
                                                <td class="text-left"> {{$service_charge }}</td>

                                                <td class="text-right"> {{$total }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="10"  class="text-right"></th>
                                                <td class="text-right"></td>
                                            </tr>

                                            <tr style="margin-top:400px;">
                                                <th scope="row" colspan="8"  class="text-right">Sub Total :</th>
                                                <td class="text-right">{{$total }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-right">
                                                    Net :</th>
                                                <td class="border-0 text-right">{{$net }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-right">
                                                    VAT :</th>
                                                <td class="border-0 text-right">{{$vat }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-right">
                                                    Service Amount :</th>
                                                <td class="border-0 text-right">{{$service_charge }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-right">
                                                    Net +VAT+Service Amount :</th>
                                                <td class="border-0 text-right">{{$total }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="8" class="border-0 text-right">Total :</th>
                                                <td class="border-0 text-right">
                                                    <h4 class="m-0">{{$total  }}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>