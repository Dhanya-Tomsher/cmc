    @if (!empty($hosp[0]))
        @php $i = 1; @endphp
        @foreach ($hosp as $app)
        <tr id="appid_{{$app->id}}">
            <td>{{ $i }} </td>
            <td>{{ $app->date_appointment }} </td>
            <td>{{ $app->time_appointment }} </td>
            <td>{{ $app->name }} </td>
            <td>{{ $app->caretaker_name }} </td>
            <!-- <td>{{ $app->customer_id }} </td> -->
            <td>{{ $app->cat_name }} </td>
            <!-- <td>{{ $app->cat_id }} </td> -->
            <!-- <td>{{ $app->procedure_name }} </td> -->
            <td>{{ date('Y-m-d',strtotime($app->created_at)) }} </td>
            <td class="text-center" id="payment_{{$app->id}}">
                @if($app->payment_confirmation == 1)
                    <a class="payment_confirmed payment_confirm" title="Update Payment Confirmation" onclick="changePaymentStatus({{$app->id}},0);"><i class="fas fa-check"></i></a>
                @else
                    <a class="payment_not_confirmed payment_confirm" title="Update Payment Confirmation" onclick="changePaymentStatus({{$app->id}},1);"><i class="fas fa-times"></i></a>
                @endif
            </td>
            <td>
                <a href="#" class="px-2 text-primary" onclick="viewAppointment({{$app->id}})" title="View Appointment"><i class="uil uil-eye font-size-18"></i></a>
                <a href="#" class="px-2 text-primary" onclick="editAppointment({{$app->id}})" title="Edit Appointment"><i class="uil uil-pen green font-size-18"></i></a>
                <a href="#" class="px-2 text-primary" onclick="deleteAppointment({{$app->id}})" title="Delete Appointment"><i class="uil uil-trash required font-size-18"></i></a>
                <a href="{{ route('get-hospital-invoice',$app->id) }}" class="px-2 text-primary" title="Invoice" ><i class="uil uil-invoice  font-size-18"></i></a>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
   
    @endif