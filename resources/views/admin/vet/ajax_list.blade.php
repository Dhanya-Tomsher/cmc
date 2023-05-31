    @if ($vet)
        @foreach ($vet as $vete)
            <tr>

                <td>{{ $loop->iteration }}</td>
                <td>{{ $vete->name }} </td>
                <td>{{ $vete->email }} </td>
                <td>{{ $vete->phone_number }} </td>
                <td>{{ $vete->whatsapp_number }} </td>
                <td>
                    <div
                        class="badge bg-soft-{{ $vete->status == 'draft' ? 'danger' : 'success' }} font-size-12 text-uppercase">
                        {{ $vete->status }}
                    </div>
                </td>
                <td>
                    <a href="{{ route('vet.view', $vete) }}"
                        class="px-3  btn btn-app"><i
                            class="uil uil-eye font-size-18 text-primary"></i> View</a>
                </td>
                <td>
                    <a href="{{ route('vet.edit', $vete) }}"
                        class="px-3  btn btn-app"><i
                            class="uil uil-pen green font-size-18"></i>Edit</a>
                </td>

            </tr>
        @endforeach
    @endif