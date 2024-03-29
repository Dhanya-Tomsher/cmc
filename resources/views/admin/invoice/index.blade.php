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
                                    <!-- <input class="form-control me-auto border-0" type="search" placeholder="Search here">
                                    <button type="button" class="btn btn_back waves-effect waves-light w-xl">Search</button> -->
                                </div>
                            </form>
                        </div>

                        <div class="btn_group">
                            <div class="input-daterange input-group">
                                <a href="{{route('invoice.create')}}" class="btn btn-primary">Create New Invoice</a>
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
                            <div class="table-responsive cat_details_table ">
                                <table class="table table-centered table-nowrap mb-0" id="invoiceTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Cat Name</th>
                                            <th>Vet Name</th>
                                            <th>Invoice Note</th>
                                            <th>Net</th>
                                            <th>VAT</th>
                                            <th>Service Charge</th>
                                            <th>Total</th>
                                            <th>Invoice Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($invoice)
                                        @foreach ($invoice as $invoicee)
                                        <tr id="appid_{{$invoicee->id}}">
                                        
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $invoicee->cat_name }} </td>
                                            <td>{{ $invoicee->vet_name }} </td>
                                            <td>{{ $invoicee->invoice_note }} </td>
                                            <td>{{ $invoicee->net }} </td>
                                            <td>{{ $invoicee->vat }} </td>
                                            <td>{{ $invoicee->service_charge }} </td>
                                            <td>{{ $invoicee->total }} </td>
                                            <td>{{ $invoicee->invoice_date }} </td>
                                            <td class="text-center">
                                                <a href="{{ route('invoice.view', $invoicee->id) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-eye"></i>View</a>
                                                <a href="{{ route('invoice.edit', $invoicee->id) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-pen"></i>Edit</a>
                                                <a href="#" onclick="deleteInvoice('{{$invoicee->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-trash"></i>Delete</a>
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
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
<style>

</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script >

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#invoiceTable').DataTable(); 
    function deleteInvoice(id){
        var el = this;
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this invoice?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
        
            if (result.isConfirmed) {
                var data = [];
                $.ajax({
                    url: "{{ route('invoice.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
                        $('#appid_'+id).css('background','#f9a8a8');
                        $('#appid_'+id).fadeOut(900,function(){
                            $(this).remove();
                        });
                        Swal.fire(
                            'Deleted successfully',
                            '',
                            'success'
                        );
                    }
                });
            } 
        
        })
    }
</script>
@endpush