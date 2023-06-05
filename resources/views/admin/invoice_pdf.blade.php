<html>
<head>
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
       
        .table th {
            font-weight: 600;
        }
        .border{
            border: 1px solid #c3bcbc !important;
        }
        .float-end{
            float:right!important;
            text-align: center;
            align-items:center;
        }
        .font-size-16 {
            font-size: 16px!important;
        }
        .font-size-12 {
            font-size: 12px!important;
        }
        .bg-success {
            --bs-bg-opacity: 1;
            background-color: #34c38f !important;
        }
        .ms-2 {
            margin-left: 0.5rem!important;
        }

        .badge {
            display: inline-block;
            padding: 0.3em 0.5em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            color: #000;
            text-align: center;
            white-space: nowrap;
            border-radius: 0.25rem;
           
        }
        .my-4 {
            margin-top: 2.5rem!important;
            margin-bottom: 1.5rem!important;
        }
        hr {
            margin: 1rem 0;
            color: inherit;
            border: 0;
            border-top: 1px solid #f6f6f6;
            opacity: .5;
        }
        @page{
            margin:0 !important;
        }
        .text-muted {
            --bs-text-opacity: 1;
            color:  #74788d !important;
        }
        .font-size-15 {
            font-size: 15px!important;
        }

        .mb-2 {
            margin-bottom: 0.5rem!important;
        }
        .mb-1 {
            margin-bottom: 0.25rem!important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
        .text-sm-end {
            text-align: right!important;
        }
        .py-2 {
            padding-top: 0.5rem!important;
            padding-bottom: 0.5rem!important;
        }
        .mb-0 {
            margin-bottom: 0!important;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #495057;
            vertical-align: top;
            border-color:#f6f6f6;
        }
        .table>thead {
            vertical-align: bottom;
        }
        
        .table>:not(:last-child)>:last-child>* {
            border-bottom-color: #f6f6f6;
        }
        .table-centered td, .table-centered th {
            vertical-align: middle!important;
        }
        .table-nowrap td, .table-nowrap th {
            white-space: nowrap;
        }
        .table>:not(caption)>*>* {
            border-bottom-width: 0;
            border-top-width: 1px;
        }
        .table th {
            font-weight: 600;
        }
        .text-end {
            text-align: right!important;
        }
        .table>tbody {
            vertical-align: middle;
        }
       
        .card {
            margin-bottom: 1.25rem;
            /* -webkit-box-shadow: 0 2px 4px rgba(15,34,58,.12);
            box-shadow: 0 2px 4px rgba(15,34,58,.12); */
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
        }
        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 25px;
            margin-top:25px;
        }

        .bg-danger{
            background-color: rgba(244,106,106,1)!important;
        }
        .row>* {
            position: relative;
        }
        div {
            display: block;
        }
        .text-center{
            text-align: center !important;
        }
        .tr-border {
            border-color: #bec3c3;
            border-style: solid;
            border-width: 2px;
        }
        body,.card-body {     background-color: #fbf5b6;
    background-image: linear-gradient(#FAF39F, white); }
       
    </style> 
</head> 
<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="col-md-12 text-center" style="">
                                    <img src="{{ $imagePath }}" style="width:200px;">
                                        <br>
                                    <span> Cats Medical Center Veterinary Clinic L.L.C. </span><br>
                                    <span><i class="fa fa-map-marker-alt"> Location : Al Murooj complex, downtown Dubai, UAE.</i></span><br>
                                    <span>  <i class="fa fa-mobile-alt"></i>Contact :&nbsp;&nbsp;04 320 4204, <i class="fab fa-whatsapp" style="color: green"></i> 04 320 4204</span>
                                </div>
                                
                                
                                <hr class="my-4">

                                <div class="row">
                                    <table class="table table-nowrap table-centered mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="">
                                                        <h5 class="font-size-15 mb-2">{{ $caretaker_name }}</h5>
                                                        <p class="mb-1">{{ $address }}</p>
                                                        <p class="mb-1">{{ $email  }}</p>
                                                        <p>{{ $phone_number  }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" text-sm-end">
                                                        <div>
                                                            <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                                            <p >
                                                                #INV{{$id }}

                                                                @if($payment_confirmation == 1)
                                                                    <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                                                @else
                                                                    <span style="margin-bottom:-3px !important;"class="badge bg-danger font-size-12 ms-2">Not Paid</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                                            <p>{{$invoice_date }} </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            <tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="py-2">
                                    <h5 class="font-size-15">Summary</h5>

                                    <div class="table-responsive">
                                        <table class="table  table-centered mb-0">
                                            <thead>
                                                <tr class="tr-border">
                                                    <!-- <th class="text-left" style="width:30px;">No.</th> -->
                                                    <th class="text-left" style="width:60px;" >Ptld</th>
                                                    <th class="text-left" style="width:180px;word-wrap:break-word;" >Service</th>
                                                    <th class="text-center" style="width:50px;" >Price</th>
                                                    <th class="text-center" style="width:50px;" >Net</th>
                                                    <th class="text-center" style="width:50px;" >VAT</th>
                                                    <th class="text-center" style="width:60px;" >Net+Vat</th>
                                                    <th class="text-center" style="width:120px;" >Service Charge</th>
                                                    <th class="text-end" style="width:40px;" >Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                
                                                <tr>
                                                    <!-- <th class="text-left"> 01</th> -->
                                                    <td class="text-left"> {{$cat_id }} </td>
                                                    <td class="text-left"> {{$service }}  </td>
                                                    <td class="text-center"> {{$price }}</td>
                                                    <td class="text-center"> {{$net }}</td>
                                                    <td class="text-center"> {{$vat }}</td>
                                                    <td class="text-center"> {{$net_vat }}</td>
                                                    <td class="text-center"> {{$service_charge }}</td>

                                                    <td class="text-end"> {{$total }}</td>
                                                </tr>
                                                
                                               
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                
                                                <tr style="margin-top:10px;">
                                                    <th scope="row" colspan="7"  class="text-right">Sub Total :</th>
                                                    <td class="text-right">{{$total }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7" class="border-0 text-right">
                                                        Net :</th>
                                                    <td class="border-0 text-right">{{$net }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7" class="border-0 text-right">
                                                        VAT :</th>
                                                    <td class="border-0 text-right">{{$vat }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7" class="border-0 text-right">
                                                        Service Amount :</th>
                                                    <td class="border-0 text-right">{{$service_charge }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7" class="border-0 text-right">
                                                        Net +VAT+Service Amount :</th>
                                                    <td class="border-0 text-right">{{$total }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="7" class="border-0 text-right">Total :</th>
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
</body>
</html>