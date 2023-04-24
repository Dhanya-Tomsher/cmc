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
                                       <form>
                                           <div class="hstack gap-2">
                                               <input class="form-control me-auto border-0" type="search" placeholder="Search here">
                                               <button type="button" class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                           </div>
                                       </form>
                                    </div>

                                <div class="btn_group">
                                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                        <input type="text" class="form-control text-start" placeholder="From" name="From">
                                        <input type="text" class="form-control text-start" placeholder="To" name="To">
                                        <button type="button" class="btn btn-primary"><i class="mdi mdi-filter-variant"></i></button>
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
                                                    @if ($caretaker)
                                                    @foreach ($caretaker as $caretake)
                                                    <tr>
                                                 
                                                        <td>{{ $caretake->id }}</td>
                                                        <td>{{ $caretake->name }} </td>
                                                        <td>{{ $caretake->email }} </td>
                                                        <td>{{ $caretake->phone_number }} </td>
                                                        <td>{{ $caretake->whatsapp_number }}  </td>                                                        
                                                        <td>
                                                            <div class="badge bg-soft-warning font-size-12">{{ $caretake->status }} </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('caretaker.view', $caretake) }}" class="px-3 text-primary"><i class="uil uil-eye font-size-18"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('caretaker.edit', $caretake) }}" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
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