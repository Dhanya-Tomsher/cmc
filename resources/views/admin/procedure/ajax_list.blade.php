    @if ($procedure)
        @foreach ($procedure as $pro)
        <tr id="proid_{{$pro->id}}">
            <td>{{ $loop->iteration }} </td>
            <td>{{ $pro->name }} </td>
            <td>{{ $pro->price }} </td>
            <td>
                @if($pro->status == 1)
                    <div class="badge bg-soft-success font-size-12">Enabled</div>
                @else
                    <div class="badge bg-soft-danger font-size-12">Disabled</div>
                @endif
            </td>
            <td>
                <a href="#" class="px-3 text-primary" onclick="editProdcedure({{$pro}});"><i class="uil uil-pen green font-size-18"></i></a>
                <a href="#" onclick="deleteProdcedure('{{$pro->id}}');" class="px-3 text-primary"><i class="uil uil-trash required font-size-18"></i></a>
            </td>
        </tr>
        @endforeach
    @endif  
                                