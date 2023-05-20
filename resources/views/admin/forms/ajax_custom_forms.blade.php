        @foreach ($custom_forms as $cform)
            <tr id="appid_{{$cform->id}}">
                <td> {{ $loop->iteration }} </td>
                <td> {{ $cform->caretaker_name }} </td>
                <td> {{ $cform->cat_name }} </td>
                <td> {{ $cform->form_title }} </td>
                <td class="text-center">
                    @if($cform->signed_status == 1)
                        <div class="badge bg-soft-success font-size-12">Signed</div>
                    @else
                        <div class="badge bg-soft-danger font-size-12">Pending</div>
                    @endif
                </td>
                <!-- <td>
                    @if($cform->status == 1)
                        <div class="badge bg-soft-success font-size-12">Active</div>
                    @else
                        <div class="badge bg-soft-danger font-size-12">Inactive</div>
                    @endif
                </td> -->
                <td> {{ $cform->created_at->format('Y-m-d') }} </td>
                <td class="text-center">
                    <a href="{{ route('custom-form.view',$cform->id) }}" class="px-3 text-primary"  title="View form data"><i class="uil uil-eye font-size-18"></i></a>
                    <a href="#" class="px-3 text-primary" onclick="deleteCustomForm('{{$cform->id}}')" title="Delete form"><i class="uil uil-trash required font-size-18"></i></a>
                </td>
            </tr>
            @endforeach