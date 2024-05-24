@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Vets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Vets</li>
                            </ol>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-50">
                            <form action="" autocomplete="off">
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="text" id='search' value="{{$search}}"
                                        name="name" placeholder="Search here">
                                    <button type="submit" class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                    <a href="{{ route('vet.index') }}" class="btn btn_back waves-effect waves-light w-md"
                                        id="searchReset">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="btn_group">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('vet.create') }}"
                                    class="btn btn_back waves-effect waves-light w-md">Create Vet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0" id="vatTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp</th>
                                            <!-- <th>Status</th> -->
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="vetDetails">
                                        @if (isset($vet[0]))
                                            @foreach ($vet as $key => $vete)
                                                <tr>

                                                    <td>{{ $key + 1 + ($vet->currentPage() - 1) * $vet->perPage() }}</td>
                                                    <td>{{ $vete->name }} </td>
                                                    <td>{{ $vete->email }} </td>
                                                    <td>{{ $vete->phone_number }} </td>
                                                    <td>{{ $vete->whatsapp_number }} </td>
                                                    <!-- <td>
                                                        <div
                                                            class="badge bg-soft-{{ $vete->status == 'draft' ? 'danger' : 'success' }} font-size-12 text-uppercase">
                                                            {{ $vete->status }}
                                                        </div>
                                                    </td> -->
                                                    <td class="text-center">
                                                        <a href="{{ route('vet.view', $vete) }}"
                                                            class="px-2 btn btn-app"><i
                                                                class="uil uil-eye font-size-18 text-primary"></i> View</a>

                                                        <a href="{{ route('vet.edit', $vete) }}"
                                                            class="px-2 btn btn-app"><i
                                                                class="uil uil-pen green font-size-18"></i>Edit</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="atbd-empty__image">
                
                                                        <img src="{{ asset('assets/images/1.svg')}}" alt="Admin Empty">
                
                                                    </div>
                                                    No data found.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination mt-3">
                                    {{ $vet->appends(request()->input())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@push('header')
<style>
    .table>:not(thead)>*>* {
        padding: 0rem 0.75rem !important;
    }
</style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // getVets(); 

        function getVets() {
            var search = $('#search').val();
            $.ajax({
                url: "{{ route('vet.list') }}",
                type: "POST",
                data: {
                    search: search
                },
                success: function(response) {
                    $('#vatTable').DataTable().clear();
                    $('#vatTable').DataTable().destroy();
                    $('#vetDetails').html(response);
                    $('#vatTable').DataTable();
                }
            });
        }

        // $("#searchReset").on("click", function (e) { 
        //     $('#search').val('');
        //     getVets(); 
        // });
    </script>
@endpush
