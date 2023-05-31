<div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>{{ $title }}</h5>
            @if($transfer_date == '')
                @if($type != 'prescriptions')
                    <a href="#"  class="btn btn_back waves-effect waves-light" onclick="showAddModal();">Add New</a>
                @else
                <a href="#"  class="btn btn_back waves-effect waves-light" onclick="showPrescriptionAddModal();">Add New</a>
                @endif
            @endif
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered  mb-0" id="journal_table">
                <thead class="table-light">
                    <tr>
                        <th class="w-10">Sl NO</th>
                        <th class="w-30">Heading</th>
                        @if($type != 'prescriptions')
                            <th class="w-10">Files</th>
                            <th class="w-10">Report Date</th>
                        @else
                            <th class="w-10">Date</th>
                        @endif
                        <th class="text-center w-10">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                        @php $i=1; @endphp
                        @foreach($data as $other)
                            <tr id="dataid_{{$other->id}}">
                                <td>{{ $i++ }}</td>
                                <td>{!! $other->heading !!} </td>
                                <!-- <td>{!! $other->remarks !!} </td> -->
                                @if($type != 'prescriptions')
                                    <td>
                                        @if($other->files)
                                            <a href="#" onclick="getJournalImages('{{ $other->file_names }}')" class="px-3 text-danger"><i class="uil uil-file-alt font-size-20"></i></a>
                                        @else
                                            <span class="px-3">- </span>
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $other->report_date }}</td>
                                
                                <td class="text-center">
                                    @if($type == 'prescriptions')
                                        <a href="#" class="px-3 text-primary" onclick='showPrescriptionModal("{{$other->id}}")'><i class="uil uil-eye font-size-20"></i></a>
                                    @else
                                        <a href="#" class="px-3 text-primary" onclick='showModal("{{$other->id}}")'><i class="uil uil-eye font-size-20"></i></a>
                                    @endif
                                    @if($transfer_date == '')
                                   
                                    <a href="#" onclick="deleteJournalData({{ $other->id }})" class="px-3 text-danger"><i class="uil uil-trash-alt required font-size-18"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade journal_data" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form  id="createJournalData"  enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Heading<span class="error">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter heading" name="heading" id="heading">
                                <span class="error hide" id="error_heading">Heading field is required. </span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Remarks</label>
                                <textarea class="form-control" type="text" placeholder="Enter Remarks" name="remark_content" id="remark_content"> </textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Choose Files</label>
                                <input class="form-control" type="file" placeholder="Enter Remarks" accept=".jpg,.jpeg,.png,.bmp,.gif,.doc,.docx,.txt,.pdf" name="files[]" multiple  id="files">
                            </div>

                            <!-- <div class="col-md-12 mb-2">
                                <label for="address" class="col-form-label">Report Date</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" name="report_date" id="report_date"  class="form-control date-picker"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                        data-date-container="#datepicker1" data-provide="datepicker"  data-date-autoclose="true"  value="">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div> -->

                            <div class="col-md-12 mt-3 text-center">
                                <input type="hidden" name="cat_id" value="{{$cat_id}}">
                                <input type="hidden" name="type" value="{{$type}}">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <a href="#" class="btn btn-primary waves-effect waves-light w-lg" onclick="addJournalDetails('{{ $title }}','{{$type}}')">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade journal_prescription_data" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form  id="createPrescriptionJournalData"  enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Heading<span class="error">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter heading" name="heading_pre" id="heading_pre">
                                <span class="error hide" id="error_heading_pre">Heading field is required. </span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Remarks</label>
                                <textarea class="form-control" type="text" placeholder="Enter Remarks" name="prescription_content" id="prescription_content"> </textarea>
                            </div>
            
                            <!-- <div class="col-md-12 mb-2">
                                <label for="address" class="col-form-label">Date</label>
                                <div class="input-group" id="datepicker2">
                                    <input type="text" name="pre_date" id="pre_date"  class="form-control date-picker"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                        data-date-container="#datepicker2" data-provide="datepicker"  data-date-autoclose="true"  value="">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div> -->

                            <div class="col-md-12 mt-3 text-center">
                                <input type="hidden" name="cat_id" value="{{$cat_id}}">
                                <input type="hidden" name="type" value="{{$type}}">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <a href="#" class="btn btn-primary waves-effect waves-light w-lg" onclick="addJournalPrescriptionDetails('{{ $title }}','{{$type}}')">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
               
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade images_data" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="min-height: 600px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="ImageList">
                        
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="show_image_popup" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="width:90%;">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div id="image-show-area">
                         <!--     popup imge -->
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="show_popup" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="" id="heading-data"> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body" style="height: 700px;overflow: auto;">
                    <div id="content-data"> </div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="show_prescription_popup" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="" id="pre-heading-data"> </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body" style="height: 700px;overflow: auto;">
                    <div id="pre-content-data"> </div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>