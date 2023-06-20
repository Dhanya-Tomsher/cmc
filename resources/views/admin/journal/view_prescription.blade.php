
        <div class="row">
            <div class="col-12">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('assets/images/logo.png') }}" style="width:200px;">
                                    <br>
                                <span> Cats Medical Center Veterinary Clinic L.L.C. </span><br>
                                <span><i class="fa fa-map-marker-alt"> Al Murooj complex, downtown Dubai, UAE.</i></span><br>
                                <span>  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204 &nbsp;&nbsp;<i class="fab fa-whatsapp" style="color: green"></i>&nbsp;&nbsp;04 320 4204</span><br>
                                <span>TRN: 100527270100003 </span>
                                
                                <div class="col-md-12 d-flex mt-4">
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Cat ID : </b></label> {{ ($journal[0]['catId']) ? $journal[0]['catId']  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Cat Name : </b></label> {{ ($journal[0]['cat_name']) ? $journal[0]['cat_name']  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Date : </b></label> {{ ($journal[0]['report_date']) ? $journal[0]['report_date']  : '' }}
                                    </div>
                                
                                </div>
                                <hr style="border-top: 1px solid #655a5ac7;">
                                <h4 class="text-center" style="font-size:16px;font-weight:700;">Prescription </h4>
                            </div>
                            <div class="col-md-12 " style="padding: 0.5rem 5rem!important;">
                                <span style="font-size:15px;font-weight:600;"> {{ $journal[0]['heading'] }} </span>
                                <p>{!!$journal[0]['remarks'] !!}</p>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </div>
                
            </div> <!-- end col-->
        </div> <!-- end row-->