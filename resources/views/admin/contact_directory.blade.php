    @if ($caretaker)
        @php  $i = 1; @endphp
        @foreach ($caretaker as $caretake)
        <tr>
            <!-- <td>{{ $i }} </td> -->
            <td>{{ $caretake->name }} </td>
            <td>{{ $caretake->email }} </td>
            <td>{{ $caretake->phone_number ? $caretake->phone_number : '-' }} </td>
            <td>{{ $caretake->whatsapp_number ? $caretake->whatsapp_number : '-' }}  </td>        
            <td>{{ $caretake->address ? $caretake->address : '-' }}  </td>                                                        
            <td>
                <a href="{{ route('caretaker.view', $caretake) }}" class="px-3 text-primary"><i  class="uil uil-eye font-size-18"></i></a>
            </td>

        </tr>
        @php  $i++; @endphp
        @endforeach
    @endif                                             
                                                 
                                                 