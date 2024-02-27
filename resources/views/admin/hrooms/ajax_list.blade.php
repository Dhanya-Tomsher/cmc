    @if ($rooms)
        @foreach ($rooms as $room)
        <tr id="roomid_{{$room->id}}">
            <td>{{ $loop->iteration }} </td>
            <td>{{ $room->room_number }} </td>
            <!-- <td>{{ $room->room_type == 'hotel' ? 'Hotel' : 'Hospital' }} </td> -->
            <td>{{ $room->branch }} </td>
            <td>{{ $room->amount }} </td>
            <td>
                @if($room->room_status == 1)
                    <div class="badge bg-soft-success font-size-12">Enabled</div>
                @else
                    <div class="badge bg-soft-danger font-size-12">Disabled</div>
                @endif
            </td>
            <td>
                <a href="{{ route('hrooms.view', $room) }}" class="px-2 btn btn-app"><i class="uil uil-eye font-size-18 text-primary"></i> View</a>
                <a href="{{ route('hrooms.edit', $room) }}" class="px-2 btn btn-app"><i class="uil uil-pen green font-size-18"></i>Edit</a>
                <a href="#" onclick="deleteRoom('{{$room->id}}');" class="px-2 btn btn-app"><i class="uil uil-trash required font-size-18"></i>Delete</a>
            </td>
        </tr>
        @endforeach
    @endif  
                                