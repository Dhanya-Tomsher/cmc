@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dashboard'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Caretaker</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Caretaker</li>
                            </ol>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-50">
                            <form action="" autocomplete="off">
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="text" id='search'
                                        value="{{ $search }}" name="name" placeholder="Search here">
                                    <button type="submit"
                                        class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                    <a href="{{ route('caretaker.index') }}"
                                        class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</a>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="btn_group">
                                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                                <input type="text" class="form-control text-start" placeholder="From" name="From">
                                                <input type="text" class="form-control text-start" placeholder="To" name="To">
                                                <button type="button" class="btn btn-primary"><i class="mdi mdi-filter-variant"></i></button>
                                            </div>
                                        </div> -->
                        <div class="btn_group">
                            <!-- <div class="d-flex justify-content-end mb-3"> -->
                            <a href="{{ route('caretaker.create') }}" class="btn btn_back waves-effect waves-light w-xl"
                                id="new_appointment">Create Caretaker</a>
                            <!-- </div>
                                            <div class="d-flex justify-content-end mb-3"> -->
                            <a href="{{ route('caretaker.blacklisted') }}"
                                class="btn btn_back waves-effect waves-light w-xl" id="blacklisted">Blacklisted
                                Caretakers</a>
                            <!-- </div> -->
                        </div>
                    </div>


                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('status'))
                                <div class="alert alert-success">
                                    {{ session()->get('status') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0" id="caretakerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th class="text-center">Customer ID</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp</th>
                                            <!-- <th>Status</th> -->
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="caretakerDetails">
                                        @if (isset($caretaker[0]))
                                           
                                            @foreach ($caretaker as $key=>$caretake)
                                                <tr>
                                                    <td>{{ $key + 1 + ($caretaker->currentPage() - 1) * $caretaker->perPage() }} </td>
                                                    <td>{{ $caretake->name }} </td>
                                                    <td class="text-center">{{ $caretake->customer_id }} </td>
                                                    <td>{{ $caretake->email }} </td>
                                                    <td>{{ $caretake->phone_number }} </td>
                                                    <td>{{ $caretake->whatsapp_number }} </td>
                                                    <!-- <td>
                                                            @if ($caretake->status == 'published')
                                                                <div class="badge bg-soft-success font-size-12">{{ $caretake->status }}</div>
                                                            @else
                                                                <div class="badge bg-soft-danger font-size-12">{{ $caretake->status }}</div>
                                                            @endif
                                                            </td> -->
                                                    <td class="text-center">
                                                        <a href="{{ route('caretaker.view', $caretake->id) }}"
                                                            class="px-3 btn btn-app"><i
                                                                class="uil uil-eye font-size-18 text-primary "></i> View</a>
                                                        <a href="{{ route('caretaker.edit', $caretake) }}"
                                                            class="px-3 btn btn-app"><i
                                                                class="uil uil-pen green font-size-18"></i> Edit</a>
                                                    </td>

                                                </tr>
                                              
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">
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
                                    {{ $caretaker->appends(request()->input())->links('pagination::bootstrap-5') }}
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
        // getCaretakers();

        function getCaretakers() {
            var search = $('#search').val();
            $.ajax({
                url: "{{ route('caretaker.list') }}",
                type: "POST",
                data: {
                    search: search
                },
                success: function(response) {
                    $('#caretakerTable').DataTable().clear();
                    $('#caretakerTable').DataTable().destroy();
                    $('#caretakerDetails').html(response);
                    $('#caretakerTable').DataTable();
                }
            });
        }

        // $("#searchReset").on("click", function(e) {
        //     $('#search').val('');
        //     getCaretakers();
        // });
    </script>
@endpush
