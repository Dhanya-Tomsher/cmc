@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Invoice'])
@section('content') 
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Invoice</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Invoice</li>
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
                                    <div class="input-daterange input-group">
                                        <a href="{{route('invoice.create')}}" class="btn btn-primary">Create</a>
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
                                                        <th>Cat ID</th>
                                                        <th>Caretaker ID</th>
                                                        <th>Invoice Date</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>View</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if ($invoice)
                                                    @foreach ($invoice as $invoicee)
                                                    <tr>
                                                 
                                                        <td>01 </td>
                                                        <td>{{ $invoicee->cat_id }} </td>
                                                        <td>{{ $invoicee->caretaker_id }} </td>
                                                        <td>{{ $invoicee->invoice_date }} </td>
                                                        <td>{{ $invoicee->amount }} </td>
                                                        <td>
                                                           
                                                            <div class="badge bg-soft-success font-size-12">{{ $invoicee->status }}</div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('invoice.view', $invoicee) }}" class="px-3 text-primary"><i class="uil uil-eye font-size-18"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('invoice.edit', $invoicee) }}" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
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