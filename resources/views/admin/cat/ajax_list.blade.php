    @if($cats)
        @php  $i = 1; @endphp
        @foreach ($cats as $cate)
       
        <tr>
            <td>{{ $i }} </td>
            <td>{{ $cate->cat_name }} </td>
            <td>
                @if($cate->image_url == NULL)
                    <a href="{{ route('cat.view', $cate) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset('assets/images/cat_plc.jpg') }} " data-holder-rendered="true"> </a>
                @else
                    <a href="{{ route('cat.view', $cate) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset($cate->image_url) }} " data-holder-rendered="true"> </a>
                @endif
                
            </td>
            <td>{{ $cate->cat_id }} </td>
            <td>{{ $cate->caretaker_name }} </td>
            <td>{{ $cate->gender }} </td>
            <!-- <td>
                @if($cate->status == 'published')
                    <div class="badge bg-soft-success font-size-12">{{ $cate->status }}</div>
                @else
                    <div class="badge bg-soft-danger font-size-12">{{ $cate->status }}</div>
                @endif
            </td> -->
            <td>
                <a href="{{ route('cat.view', $cate) }}" class="px-3 btn btn-app"><i  class="uil uil-eye font-size-18 text-primary"></i>View</a>
                <a href="{{ route('cat.edit', $cate) }}" class="px-3 btn btn-app"><i class="uil uil-pen green font-size-18"></i>Edit</a>
                <!-- <a href="#" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a> -->
            </td>
        </tr>
        @php  $i++; @endphp
        @endforeach
    @endif


    