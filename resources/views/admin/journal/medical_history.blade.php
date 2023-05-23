    <div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>Vitals</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target=".med_history" class="btn btn_back waves-effect waves-light">Add</a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered table-nowrap mb-0" id="journal_table">
                <thead class="table-light">
                    <tr>
                        <th>Sl NO</th>
                        <th>Weight</th>
                        <th>Temperature</th>
                        <th>Blood Pressure</th>
                        <th>Report Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                        @php $i=1; @endphp
                        @foreach($data as $med)
                            <tr id="medid_{{$med->id}}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $med->weight ? $med->weight : '-' }} </td>
                                <td>{{ $med->temperature ? $med->temperature : '-' }}</td>
                                <td>{{ $med->blood_pressure ? $med->blood_pressure : '-' }}</td>
                                <td>{{ $med->report_date }}</td>
                                <td><a href="#" onclick="deleteMedicalHistory({{ $med->id }})" class="px-3 text-danger"><i class="uil uil-trash-alt required font-size-18"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade med_history" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add Vitals</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form  id="createMedicalHistory"  enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="Document" class="col-form-label pt-0">Weight</label>
                                <input class="form-control" type="text" placeholder="Enter Weight" id="weight" name="weight">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Document" class="col-form-label pt-0">Temperature</label>
                                <input class="form-control" type="text" placeholder="Enter Temperature" id="temperature" name="temperature">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Document" class="col-form-label pt-0">Blood Pressure</label>
                                <input class="form-control" type="text" placeholder="Enter Blood Pressure" id="blood_pressure" name="blood_pressure">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="address" class="col-form-label pt-0">Report Date</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" name="report_date" id="report_date"  class="form-control date-picker"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                        data-date-container="#datepicker1" data-provide="datepicker"  data-date-autoclose="true"  value="">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 text-center">
                                <input type="hidden" name="cat_id" value="{{$cat_id}}">
                                <span class="error hide p-2" id="error_medical" >Atleast one vital field is required.</span>
                            </div>


                            <div class="col-md-12 mt-3 text-center">
                                <a href="#" class="btn btn-primary waves-effect waves-light w-lg" onclick="addMedicalHistory()">Add</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>