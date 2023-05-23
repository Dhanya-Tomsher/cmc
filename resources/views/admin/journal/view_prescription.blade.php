
        <div class="row">
            <div class="col-12">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('assets/images/logo.png') }}" style="width:200px;">
                                    <br>
                                <h5> Cats Medical Center Veterinary Clinic L.L.C. </h5>
                                <h6><i class="fa fa-map-marker-alt"> Al Murooj complex, downtown Dubai, UAE.</i></h6>
                                <h6>  <i class="fa fa-mobile-alt"></i>&nbsp;&nbsp;04 320 4204 &nbsp;&nbsp;<i class="fab fa-whatsapp" style="color: green"></i>&nbsp;&nbsp;04 320 4204</h6>
                                
                                
                                <div class="col-md-12 d-flex mt-4">
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Cat Name : </b></label> {{ ($journal[0]['cat_name']) ? $journal[0]['cat_name']  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Caretaker Name : </b></label> {{ ($journal[0]['caretaker_name']) ? $journal[0]['caretaker_name']  : '' }}
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="col-form-label"><b>Date : </b></label> {{ ($journal[0]['report_date']) ? $journal[0]['report_date']  : '' }}
                                    </div>
                                
                                </div>
                                <hr style="border-top: 1px solid #655a5ac7;">
                            </div>
                            <div class="col-md-12 p-5">
                                {!!$journal[0]['remarks'] !!}
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </div>
                
            </div> <!-- end col-->
        </div> <!-- end row-->