  
<style>
    .text-center{
        text-align: center!important;
    }
    .col-md-4{
        width: 33% !important;
        float : left !important;
    }
    hr{
        margin-top: 7% !important;
    }
    .mt-4{
        margin-top: 7% !important;
    }
    body,.card-body { background-color: #fcf7bd !important; }
    @page{
        margin:0 !important;
    }
    body{
        padding : 7% !important;
    }
</style>
<div class="row">
            <div class="col-12">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 text-center" style="">
                                <img src="{{ $imagePath }}" style="width:200px;">
                                <br>
                                <span> Cats Medical Center Veterinary Clinic L.L.C. </span><br>
                                <span><i class="fa fa-map-marker-alt"> Location : Al Murooj complex, downtown Dubai, UAE.</i></span><br>
                                <span>Contact :  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204, <i class="fab fa-whatsapp" style="color: green"></i> 04 320 4204</span>
                                <br><span>TRN: 100527270100003 </span>
                                <div class="col-md-12 d-flex mt-4">
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Cat ID : </b></label> {{ ($catId) ? $catId  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Cat Name : </b></label> {{ ($cat_name) ? $cat_name  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Date : </b></label> {{ ($report_date) ? $report_date  : '' }}
                                    </div>
                                
                                </div>
                                <hr style="border-top: 1px solid #655a5ac7;">
                                <h4 class="text-center" style="font-size:16px;font-weight:700;">Prescription </h4>
                            </div>
                            <div class="col-md-12 " style="padding: 0.5rem 5rem!important;">
                                <span style="font-size:15px;font-weight:600;"> {{ $heading }} </span>
                                <p>{!! $remarks !!}</p>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </div>
                
            </div> <!-- end col-->
        </div> <!-- end row-->