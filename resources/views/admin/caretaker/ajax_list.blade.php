    @if ($caretaker)
        @php  $i = 1; @endphp
        @foreach ($caretaker as $caretake)
        <tr>
            <td>{{ $i }} </td>
            <td>{{ $caretake->name }} </td>
            <td>{{ $caretake->customer_id }} </td>
            <td>{{ $caretake->email }} </td>
            <td>{{ $caretake->phone_number }} </td>
            <td>{{ $caretake->whatsapp_number }}  </td>                                                        
            <td>
                @if($caretake->status == 'published')
                    <div class="badge bg-soft-success font-size-12">{{ $caretake->status }}</div>
                @else
                    <div class="badge bg-soft-danger font-size-12">{{ $caretake->status }}</div>
                @endif
            </td>
            <td>
                <a href="{{ route('caretaker.view', $caretake) }}" class="px-3 text-primary"><i  class="uil uil-eye font-size-18"></i></a>
                <a href="{{ route('caretaker.edit', $caretake) }}" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
            </td>

        </tr>
        @php  $i++; @endphp
        @endforeach
    @endif                                             
                                                 
                                                 