<div class="tab-pane fade show active">
        <div class="d-flex justify-content-between">
            <h5>{{ $title }}</h5>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-centered  mb-0" >
                <thead class="table-light">
                    <tr>
                        <th class="w-10">Sl NO</th>
                        <th class="w-30">From Caretaker</th>
                        <th class="w-30">To Caretaker</th>
                        <th class="text-center w-15">Transfer Date</th>
                        <th class="text-center w-15">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                        @foreach($data as $other)
                            <tr id="dataid_{{$other->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{!! $other->care_from_name !!} </td>
                                <!-- <td>{!! $other->remarks !!} </td> -->
                                <td>
                                    {{ $other->care_to_name }}
                                </td>
                                <td class="text-center">
                                    {{ ($other->transfer_status == 1) ? $other->transfer_date : '' }}
                                </td>
                                <td class="text-center">
                                    @php  
                                        $transfer_status = ($other->transfer_status == 1) ? '<span class="badge bg-soft-danger font-size-12 text-uppercase">Transferred</span>' : '<span class="badge bg-soft-success font-size-12 text-uppercase">Owned</span>';
                                    @endphp
                                    {!! $transfer_status !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
