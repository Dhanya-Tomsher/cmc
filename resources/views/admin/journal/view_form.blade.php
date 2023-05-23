
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12 text-center">
                                    <h3>{{$form[0]['form_title']}}</h3>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    {!!$form[0]['form_content'] !!}
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <label class="col-form-label"><b>Caretaker Name : </b></label> {{$form[0]['caretaker_name']}}
                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['caretaker_name']}}"> -->
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-form-label"><b>Cat Name : </b></label> {{$form[0]['cat_name']}}
                                        <!-- <input type="text" class="form-control me-auto" value="{{$form[0]['cat_name']}}"> -->
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        <label class="col-form-label"><b>Date : </b></label> {{ ($form[0]['signed_status'] == 1) ? $form[0]['signed_date']  : '' }}
                                        <!-- <input type="text" class="form-control me-auto" value="{{ date('Y-m-d') }}"> -->
                                    </div>
                                    <div class="col-md-7" @if($form[0]['signed_status'] == 0) style="display:none;" @endif>
                                        <label class="col-form-label"><b>Signature</b></label>
                                        @if($form[0]['signed_status'] == 1 && $form[0]['signature_url'] != '')
                                            <img src="{{ asset($form[0]['signature_url']) }}" class="w-80"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->