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
        /* body,.card-body {     background-color: #fbf5b6;
    background-image: linear-gradient(#FAF39F, white); } */
    #headerImage{
            /* Background pattern from Toptal Subtle Patterns */
            background-image: url("{{$backlogo}}");
            height: 120px;
            width: 100%;
            padding: 1%;
            background-size: contain;
        }
        #catsLogo{
            margin-top: 5px;
        }
    </style> 
</head> 
<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="padding-left: 60px; padding-right: 60px;">

                                <div class="col-md-12 text-center" id="headerImage">
                                    <img src="{{ $imagePath }}" style="width:200px;" id="catsLogo">
                                        <br>
                                    <span> Cats Medical Center Veterinary Clinic L.L.C. </span><br>
                                    <span><i class="fa fa-map-marker-alt"> Location : Al Murooj complex, downtown Dubai, UAE.</i></span><br>
                                    <span>Contact :  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204, <i class="fab fa-whatsapp" style="color: green"></i> 04 320 4204</span>
                                    <br><span>TRN: 100527270100003 </span>
                                </div>

                                <div class="row">
                                    <table class="table  table-centered mb-0">
                                        <tbody>
                                            <tr>
                                                <td style="width:40% !important;vertical-align: middle !important;">
                                                    <div class="">
                                                        <h5 class="font-size-15 mb-0">Cat Name: {{$cat_name}}</h5>
                                                    </div>
                                                </td>
                                                <td style="width:20% !important;text-align: center; padding: 0 !important; vertical-align: middle !important;">
                                                    <h5 class="mb-0" style="font-size:18px;">Invoice</h5>
                                                </td>
                                                <td style="width:40% !important;text-align: center; padding: 0 !important; vertical-align: middle !important;">
                                                    <div class=" text-sm-end">
                                                        <div>
                                                            <h5 class="font-size-16 mb-1">Invoice No:</h5>
                                                            <span >
                                                                #CINV{{$id }}
                                                            </span>
                                                        </div>
                                                        <div class="mt-0">
                                                            <h5 class="font-size-16 mb-1">Invoice Date:</h5>
                                                            <span>{{$invoice_date }} </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            <tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class=" mb-2"  style="margin-top: 0;">
                                    <h5 class="font-size-15">Summary</h5>

                                    <div class="table-responsive">
                                        <table class="table  table-centered">
                                            <thead>
                                                <tr class="tr-border">
                                                    <!-- <th class="text-left" style="width:30px;">No.</th> -->
                                                    <th class="text-left" style="width:60px;" >No.</th>
                                                    <th class="text-left" style="width:180px;word-wrap:break-word;" >Service</th>
                                                    <th class="text-center" style="width:40px;" >Quantity</th>
                                                    <th class="text-center" style="width:40px;" >Price</th>
                                                    <th class="text-center" style="width:40px;" >Net</th>
                                                    <!-- <th class="text-center" style="width:50px;" >VAT</th>
                                                    <th class="text-center" style="width:60px;" >Net+Vat</th> -->
                                                    <th class="text-center" style="width:100px;" >Service Charge</th>
                                                    <th class="text-end" style="width:80px;" >Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr> -->
                                                <!-- <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr> -->
                                                @php $subTotal = 0; @endphp
                                                @foreach($details as $invDet)
                                                <tr style="line-height: 2;">
                                                    <th class="text-left">{{ $loop->iteration }}</th>
                                                    <td class="text-left">
                                                        {{$invDet['procedure']}}
                                                    </td>
                                                    <td class="text-center">{{$invDet['quantity']}}</td>
                                                    <td class="text-center">{{$invDet['unit_price']}}</td>
                                                    <td class="text-center">{{$invDet['net']}}</td>
                                                    <!-- <td class="text-center">{{$invDet['vat']}}</td>
                                                    <td class="text-center">{{$invDet['net_vat']}}</td> -->
                                                    <td class="text-center">{{$invDet['service_charge']}}</td>

                                                    <td class="text-end">{{$invDet['net'] + $invDet['service_charge']}}</td>
                                                </tr>
                                                @php  $subTotal = $subTotal + ($invDet['net'] + $invDet['service_charge']); @endphp
                                                @endforeach
                                                
                                                <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <!-- <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6"  class="text-right"></th>
                                                    <td class="text-right"></td>
                                                </tr> -->
                                                
                                                <tr style="margin-top:10px;">
                                                    <th scope="row" colspan="6"  class="text-right">Sub Total :</th>
                                                    <td class="text-right">{{$subTotal }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6" class="border-0 text-right">
                                                        Net :</th>
                                                    <td class="border-0 text-right">{{$net }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6" class="border-0 text-right">
                                                        VAT :</th>
                                                    <td class="border-0 text-right">{{$vat }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6" class="border-0 text-right">
                                                        Service Amount :</th>
                                                    <td class="border-0 text-right">{{$service_charge }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6" class="border-0 text-right">
                                                        Net +VAT+Service Amount :</th>
                                                    <td class="border-0 text-right">{{$total }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="6" class="border-0 text-right">Total :</th>
                                                    <td class="border-0 text-right">
                                                        <h3 class="m-0"><span style="font-size:16px;float:left;margin-top:3px;margin-left:6px;">AED</span>{{$total  }}</h3>
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