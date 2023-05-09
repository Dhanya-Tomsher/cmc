    @if(!empty($bookings[0]))
        @php  $i = 1; @endphp
        @foreach ($bookings as $app)
            <tr id="appid_{{$app->id}}">
                <td>{{ $i }} </td>
                <td>{{ $app->start_date }} </td>
                <td>{{ $app->end_date }} </td>
                <td>{{ $app->room_no }} </td>
                <td>{{ $app->caretaker_name }} </td>
                <td>{{ $app->customer_id }} </td>
                <td>{{ $app->cat_name }} </td>
                <td>{{ $app->cat_id }} </td>
                <td>{{ date('Y-m-d',strtotime($app->created_at)) }} </td>
                <td>
                    <a href="#" class="px-3 text-primary" onclick="deleteBooking({{$app->id}})"><i
                            class="uil uil-trash required font-size-18"></i></a>
                </td>
            </tr>
            @php $i++; @endphp
        @endforeach
    @endif