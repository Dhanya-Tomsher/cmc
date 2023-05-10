<div class="tab-pane fade show active">
    <div class="d-flex justify-content-between">
        <h5>{{$title}}</h5>
        <a href="#" data-bs-toggle="modal" data-bs-target=".virus_test"  class="btn btn_back waves-effect waves-light">Add</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-centered table-nowrap mb-0" id="journal_table">
            <thead class="table-light">
                <tr>
                    <th>Sl NO</th>
                    <th>Calicivirus</th>
                    <th>Feline Coronavirus</th>
                    <th>Feline Herpes 1</th>
                    <th>FeLv</th>
                    <th>FIV</th>
                    <th>Panleukopenia</th>
                    <th>Others</th>
                    <th>Report Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($data)
                @php $i=1; @endphp
                @foreach($data as $virus)
                <tr class="text-center" id="virusid_{{$virus->id}}">
                    <td>{{ $i++ }}</td>
                    <td>{!! ($virus->calicivirus == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->coronavirus == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->herpesvirus == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->felv == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->fiv == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->panleukopenia == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{!! ($virus->others == 1) ? '<span class="error f-20">+ </span>' : '<span
                            class="green f-20">-</span>' !!} </td>
                    <td>{{ $virus->report_date }}</td>
                    <td><a href="#" onclick="deleteVirusTest({{ $virus->id }})" class="px-3 text-danger"><i  class="uil uil-trash-alt font-size-18"></i></a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade  virus_test" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
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
                            <label for="Document" class="col-form-label pt-0">Calicivirus</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="calicivirusYes" name="calicivirus" class="form-check-input" value="1">
                                    <label class="form-check-label f-20" for="calicivirusYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="calicivirusNp" name="calicivirus" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20" for="calicivirusNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label pt-0">Feline Coronavirus</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="coronavirusYes" name="coronavirus" class="form-check-input" value="1">
                                    <label class="form-check-label f-20" for="coronavirusYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="coronavirusNo" name="coronavirus" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20" for="coronavirusNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="Document" class="col-form-label pt-0">Feline Herpes 1</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="herpesYes" name="herpes" class="form-check-input" value='1'>
                                    <label class="form-check-label f-20" for="herpesYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="herpestNo" name="herpes" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20" for="herpesNo">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label pt-0">FeLv</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="felvYes" name="felv" class="form-check-input" value='1'>
                                    <label class="form-check-label f-20" for="felvYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="felvNo" name="felv" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20" for="felvNo">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label pt-0">FIV</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="fivYes" name="fiv" class="form-check-input" value="1">
                                    <label class="form-check-label f-20" for="fivYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="fivNo" name="fiv" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20" for="fivNo">-</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label pt-0">Panleukopenia</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="panleukopeniaYes" name="panleukopenia" class="form-check-input" value="1">
                                    <label class="form-check-label f-20" for="PregnantYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="panleukopeniaNo" name="panleukopenia" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20 f-20" for="PregnantNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="Document" class="col-form-label pt-0">Others</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="otherYes" name="others" class="form-check-input" value="1">
                                    <label class="form-check-label f-20" for="otherYes">+</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="otherNo" name="others" class="form-check-input" value="0" checked>
                                    <label class="form-check-label f-20 f-20" for="otherNo">-</label>
                                </div>
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