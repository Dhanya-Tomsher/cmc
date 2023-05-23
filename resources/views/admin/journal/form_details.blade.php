<div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>{{ $title }}</h5>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered  mb-0" id="journal_table">
                <thead class="table-light">
                    <tr>
                        <th class="w-10">Sl NO</th>
                        <th class="w-40">Form Title</th>
                        <th class="w-20">Caretaker</th>
                        <th class="w-20">Signed Date</th>
                        <th class="w-10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                        @php $i=1; @endphp
                        @foreach($data as $other)
                            <tr id="dataid_{{$other->id}}">
                                <td>{{ $i++ }}</td>
                                <td>{!! $other->form_title !!} </td>
                                <!-- <td>{!! $other->remarks !!} </td> -->
                                <td>
                                    {{ $other->caretaker_name }}
                                </td>
                                <td>{{ $other->signed_date }}</td>
                                <td>
                                    <a href="#" class="px-3 text-primary" onclick='showFormModal("{{$other->id}}")'><i class="uil uil-eye font-size-20"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
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
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>