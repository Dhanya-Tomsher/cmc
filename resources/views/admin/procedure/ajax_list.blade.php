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
                <a href="#" class="px-2 btn btn-app" onclick="editProdcedure({{$pro}});"><i class="uil uil-pen green font-size-18 text-primary"></i>Edit</a>
                <a href="#" onclick="deleteProdcedure('{{$pro->id}}');" class="px-2 btn btn-app"><i class="uil uil-trash required font-size-18"></i>Delete</a>
            </td>
        </tr>
        @endforeach
    @endif  
                                