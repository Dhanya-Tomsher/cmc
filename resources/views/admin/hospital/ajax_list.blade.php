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
            <td>{{ $app->procedure_name }} </td>
            <td>{{ date('Y-m-d',strtotime($app->created_at)) }} </td>
            <td>
                <a href="#" class="px-3 text-primary" onclick="viewAppointment({{$app->id}})"><i class="uil uil-eye font-size-18"></i></a>
                <a href="#" class="px-3 text-primary" onclick="editAppointment({{$app->id}})"><i class="uil uil-pen green font-size-18"></i></a>
                <a href="#" class="px-3 text-primary" onclick="deleteAppointment({{$app->id}})"><i class="uil uil-trash required font-size-18"></i></a>
            </td>
        </tr>
        @php $i++; @endphp
        @endforeach
   
    @endif