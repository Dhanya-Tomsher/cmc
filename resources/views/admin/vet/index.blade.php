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
                            <form>
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" type="search" placeholder="Search here">
                                    <button type="button"
                                        class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="btn_group">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('vet.create') }}"
                                    class="btn btn_back waves-effect waves-light w-md">Add</a>
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
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp</th>
                                            <th>Status</th>
                                            <th>View</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                            class="px-3 text-primary"><i
                                                                class="uil uil-eye font-size-18"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('vet.edit', $vete) }}"
                                                            class="px-3 text-primary"><i
                                                                class="uil uil-pen font-size-18"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
@endpush
