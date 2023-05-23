<div class="tab-pane fade show active">
    <div class="d-flex justify-content-between">
        <h5>{{$title}}</h5>
        <a href="#" data-bs-toggle="modal" data-bs-target=".virus_test"  class="btn btn_back waves-effect waves-light">Add</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-centered mb-0"  id="journal_table">
            <thead class="table-light">
                <tr>
                    <th >Sl NO</th>
                    <th>Calicivirus</th>
                    <th>Feline <br>Coronavirus</th>
                    <th>Feline <br> Herpes 1</th>
                    <th>FeLv</th>
                    <th>FIV</th>
                    <th>Panleukopenia</th>
                    <th class="w-20">Others</th>
                    <th>Report Date</th>
                    <th class="w-5">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($data)
                @php $i=1; @endphp
                @foreach($data as $virus)
                <tr id="virusid_{{$virus->id}}">
                    <td class="text-center">{{ $i++ }}</td>
                    
                    <td class="text-center">{!! ($virus->calicivirus == 1) ? '<span class="error f-14">+ve </span>' : (($virus->calicivirus == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>
                    <td class="text-center">{!! ($virus->coronavirus == 1) ? '<span class="error f-14">+ve </span>' : (($virus->coronavirus == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>
                    <td class="text-center">{!! ($virus->herpesvirus == 1) ? '<span class="error f-14">+ve </span>' : (($virus->herpesvirus == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>
                    <td class="text-center">{!! ($virus->felv == 1) ? '<span class="error f-14">+ve </span>' : (($virus->felv == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>
                    <td class="text-center">{!! ($virus->fiv == 1) ? '<span class="error f-14">+ve </span>' : (($virus->fiv == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>
                    <td class="text-center">{!! ($virus->panleukopenia == 1) ? '<span class="error f-14">+ve </span>' : (($virus->panleukopenia == 0) ? '<span class="green f-14">-ve</span>' : '') !!} </td>

                    <td>
                        @php 
                            $other1_name = ($virus->other_name != '') ? '('.$virus->other_name.')' : '(Others 1)';
                            $other2_name = ($virus->other2_name != '') ? '('.$virus->other2_name.')' : '(Others 2)';
                            $other3_name = ($virus->other3_name != '') ? '('.$virus->other3_name.')' : '(Others 3)';
                            $other1 = ($virus->others == 1) ? "<span class='error f-14'>+ve ". $other1_name."</span>" : (($virus->others == 0) ? "<span class='green f-14'>-ve ".$other1_name." </span>" : '' );
                            $other2 = ($virus->others_2 == 1) ? "<span class='error f-14'>+ve ". $other2_name."</span>" : (($virus->others_2 == 0) ? "<span class='green f-14'>-ve ".$other2_name." </span>" : '' );
                            $other3 = ($virus->others_3 == 1) ? "<span class='error f-14'>+ve ". $other3_name."</span>" : (($virus->others_3 == 0) ? "<span class='green f-14'>-ve ".$other3_name." </span>" : '' );
                        @endphp

                        {!! $other1 !!} <br>
                        {!! $other2 !!}  <br>
                        {!! $other3 !!}  <br>
                    </td>
                    
                    <td class="text-center">{{ $virus->report_date }}</td>
                    <td class="text-center"><a href="#" onclick="deleteVirusTest({{ $virus->id }})" class="px-3 text-danger"><i  class="uil uil-trash-alt font-size-18"></i></a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade  virus_test" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form  id="createVirusTest"  enctype="multipart/form-data" method="POST">
                    <div class="row">
                        
                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label fw-700">Calicivirus</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="calicivirusYes" name="calicivirus" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="calicivirusYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="calicivirusNp" name="calicivirus" class="form-check-input" value="0" >
                                    <label class="form-check-label f-14 mt-1" for="calicivirusNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="calicivirusUk" name="calicivirus" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="calicivirusUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label fw-700">Feline Coronavirus</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="coronavirusYes" name="coronavirus" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="coronavirusYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="coronavirusNo" name="coronavirus" class="form-check-input" value="0" >
                                    <label class="form-check-label f-14 mt-1" for="coronavirusNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="coronavirusUk" name="coronavirus" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="coronavirusUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="Document" class="col-form-label fw-700">Feline Herpes 1</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="herpesYes" name="herpes" class="form-check-input" value='1'>
                                    <label class="form-check-label f-14 mt-1" for="herpesYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="herpestNo" name="herpes" class="form-check-input" value="0" >
                                    <label class="form-check-label f-14 mt-1" for="herpesNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="herpestUk" name="herpes" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="herpestUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label fw-700">FeLv</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="felvYes" name="felv" class="form-check-input" value='1'>
                                    <label class="form-check-label f-14 mt-1" for="felvYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="felvNo" name="felv" class="form-check-input" value="0">
                                    <label class="form-check-label f-14 mt-1" for="felvNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="felvUk" name="felv" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="felvUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label fw-700">FIV</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="fivYes" name="fiv" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="fivYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="fivNo" name="fiv" class="form-check-input" value="0" >
                                    <label class="form-check-label f-14 mt-1" for="fivNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="fivUk" name="fiv" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="fivUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label fw-700">Panleukopenia</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="panleukopeniaYes" name="panleukopenia" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="PregnantYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="panleukopeniaNo" name="panleukopenia" class="form-check-input" value="0" >
                                    <label class="form-check-label f-14 mt-1" for="PregnantNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="panleukopeniaUk" name="panleukopenia" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="panleukopeniaUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="name" class="col-form-label fw-700"><p class="other_name">Others 1</p><i class="icon-star"></i></label>
                            <span class="" onclick="createNames('other_name')"><i class="uil uil-pen font-size-18"></i></span>
                            <input type="hidden" name="text_other_name" id="text_other_name" value="" >
                            <!-- <label for="Document" class="col-form-label fw-700">Others 1</label> -->
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="otherYes" name="others" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="otherYes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="otherNo" name="others" class="form-check-input" value="0" >
                                    <label class="form-check-label  f-14 mt-1" for="otherNo">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="otherUk" name="others" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="otherUk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="name" class="col-form-label fw-700"><p class="other2_name">Others 2</p><i class="icon-star"></i></label>
                            <span class="" onclick="createNames('other2_name')"><i class="uil uil-pen font-size-18"></i></span>
                            <input type="hidden" name="text_other2_name" id="text_other2_name" value="" >
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other2Yes" name="others2" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="other2Yes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other2No" name="others2" class="form-check-input" value="0" >
                                    <label class="form-check-label  f-14 mt-1" for="other2No">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other2Uk" name="others2" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="other2Uk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="name" class="col-form-label fw-700"><p class="other3_name">Others 3</p><i class="icon-star"></i></label>
                            <span class="" onclick="createNames('other3_name')"><i class="uil uil-pen font-size-18"></i></span>
                            <input type="hidden" name="text_other3_name" id="text_other3_name" value="" >
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other3Yes" name="others3" class="form-check-input" value="1">
                                    <label class="form-check-label f-14 mt-1" for="other3Yes">+ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other3No" name="others3" class="form-check-input" value="0" >
                                    <label class="form-check-label  f-14 mt-1" for="other3No">-ve</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="other3Uk" name="others3" class="form-check-input" value="2" checked>
                                    <label class="form-check-label f-14 mt-1" for="other3Uk">Unknown</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="address" class="col-form-label fw-700">Report Date</label>
                            <div class="input-group" id="datepicker1">
                                <input type="text" name="report_date" id="report_date"  class="form-control date-picker"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                    data-date-container="#datepicker1" data-provide="datepicker"  data-date-autoclose="true"  value="">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3 text-center">
                            <input type="hidden" name="cat_id" value="{{$cat_id}}">
                            <input type="hidden" name="type" value="{{$type}}">
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <a href="#" class="btn btn-primary waves-effect waves-light w-lg" data-bs-dismiss="modal" onclick="addVirusTest()" aria-label="Close">Add</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('scripts')

<script>
    

    
</script>
@endpush