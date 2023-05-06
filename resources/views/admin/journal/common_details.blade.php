<div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>{{ $title }}</h5>
            <a href="#" data-bs-toggle="modal" data-bs-target=".journal_data" class="btn btn_back waves-effect waves-light">Add</a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered table-nowrap mb-0" id="journal_table">
                <thead class="table-light">
                    <tr>
                        <th>Sl NO</th>
                        <th>Remarks</th>
                        <th>Images</th>
                        <th>Report Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                        @php $i=1; @endphp
                        @foreach($data as $other)
                            <tr id="dataid_{{$other->id}}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $other->remarks }} </td>
                                <td>
                                    @if($other->files)
                                        <a href="#" onclick="getJournalImages('{{ $other->file_names }}')" class="px-3 text-danger"><i class="uil uil-file-alt font-size-20"></i></a>
                                    @else
                                        <span class="px-3">- </span>
                                    @endif
                                </td>
                                <td>{{ $other->report_date }}</td>
                                <td><a href="#" onclick="deleteJournalData({{ $other->id }})" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a></td>
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
                                <label for="Document" class="col-form-label pt-0">Remarks <span class="error">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter Remarks" name="remarks" id="remarks">
                                <span class="error hide" id="error_details">Remarks field is required. </span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="Document" class="col-form-label pt-0">Choose Files</label>
                                <input class="form-control" type="file" placeholder="Enter Remarks" accept="image/*" name="files[]" multiple  id="files">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <input type="hidden" name="cat_id" value="{{$cat_id}}">
                                <input type="hidden" name="type" value="{{$type}}">
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <a href="#" class="btn btn-primary waves-effect waves-light w-lg" onclick="addJournalDetails('{{ $title }}','{{$type}}')">Add</a>
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
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Images</h5>
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div id="image-show-area">
                        <img id="large-image" class="w-100 h-800" src="" alt=""> <!--     popup imge -->
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>