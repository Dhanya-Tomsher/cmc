    @if($cats)
        @php  $i = 1; @endphp
        @foreach ($cats as $cate)
        <tr>
            <td>{{ $i }} </td>
            <td>{{ $cate->cat_name }} </td>
            <td>{{ $cate->cat_id }} </td>
            <td>{{ $cate->caretaker_name }} </td>
            <td>{{ $cate->gender }} </td>
            <td>
                @if($cate->status == 'published')
                    <div class="badge bg-soft-success font-size-12">{{ $cate->status }}</div>
                @else
                    <div class="badge bg-soft-danger font-size-12">{{ $cate->status }}</div>
                @endif
            </td>
            <td>
                <a href="{{ route('cat.view', $cate) }}" class="px-3 text-primary"><i  class="uil uil-eye font-size-18"></i></a>
                <a href="{{ route('cat.edit', $cate) }}" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                <!-- <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a> -->
            </td>
        </tr>
        @php  $i++; @endphp
        @endforeach
    @endif