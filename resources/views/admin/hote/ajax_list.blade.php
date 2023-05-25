    @if(!empty($bookings[0]))
        @php  $i = 1; @endphp
        @foreach ($bookings as $app)
            <tr id="appid_{{$app->id}}">
                <td>{{ $i }} </td>
                <td>{{ $app->start_date }} </td>
                <td>{{ $app->end_date }} </td>
                <td>{{ $app->room_no }} </td>
                <td>{{ $app->caretaker_name }} </td>
                <!-- <td>{{ $app->customer_id }} </td> -->
                <td>{{ $app->cat_name }} </td>
                <!-- <td>{{ $app->cat_id }} </td> -->
                <td>{{ date('Y-m-d',strtotime($app->created_at)) }} </td>
                <td class="text-center" id="payment_{{$app->id}}">
                    @if($app->payment_confirmation == 1)
                        <a class="payment_confirmed payment_confirm" title="Update Payment Confirmation" onclick="changePaymentStatus({{$app->id}},0);"><i class="fas fa-check"></i></a>
                    @else
                        <a class="payment_not_confirmed payment_confirm" title="Update Payment Confirmation" onclick="changePaymentStatus({{$app->id}},1);"><i class="fas fa-times"></i></a>
                    @endif
                </td>
                
                <td>
                    <a href="#" class="px-2 text-primary" onclick="viewBooking({{$app->id}})" title="View Booking"><i class="uil uil-eye font-size-18"></i></a>
                    <a href="#" class="px-2 text-primary" onclick="editBooking({{$app->id}})" title="Edit Booking"><i class="uil uil-pen green font-size-18"></i></a>
                    <a href="#" class="px-2 text-primary" onclick="deleteBooking({{$app->id}})" title="Delete Booking"><i class="uil uil-trash required font-size-18"></i></a>
                    <a href="{{ route('get-hotel-invoice',$app->id) }}" class="px-2 text-primary" title="Invoice" ><i class="uil uil-invoice  font-size-18"></i></a>
                </td>
            </tr>
            @php $i++; @endphp
        @endforeach
    @endif