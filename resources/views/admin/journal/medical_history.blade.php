    <div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>Medical History</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target=".med_history" class="btn btn_back waves-effect waves-light">Add</a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Sl NO</th>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Temperature</th>
                        <th>B.P</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>01-02-2022 </td>
                        <td>4.5 kg</td>
                        <td>102.5°F</td>
                        <td>120 mmHg</td>
                        <td>Medical History</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>06-03-2022 </td>
                        <td>3 kg</td>
                        <td>95.5°F</td>
                        <td>110 mmHg</td>
                        <td>Medical History</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade med_history" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add Medical History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form  id="createMedicalHistory"  enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="Document" class="col-form-label pt-0">Weight</label>
                                <input class="form-control" type="text" placeholder="Enter Weight" id="weight" name="weight">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="Document" class="col-form-label pt-0">Temperature</label>
                                <input class="form-control" type="text" placeholder="Enter Temperature" id="temperature" name="temperature">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="Document" class="col-form-label pt-0">B.P</label>
                                <input class="form-control" type="text" placeholder="Enter B.P" id="bp" name="bp">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <a href="#" class="btn btn-primary waves-effect waves-light w-lg">Add</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>