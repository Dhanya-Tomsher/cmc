@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Dynamic Invoices'])
@section('content') 
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dynamic Invoices</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="search_warpper w-50">
                            <form action="" autocomplete="off">
                                <div class="hstack gap-2">
                                    <input class="form-control me-auto border-0" name="name"  value="{{$search}}" type="text" placeholder="Search here">
                                    <button type="submit" class="btn btn_back waves-effect waves-light w-xl">Search</button>
                                    <a href="{{ route('dynamic-invoice.index') }}" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</a>
                                </div>
                            </form>
                        </div>

                        <div class="btn_group">
                            <div class="input-daterange input-group">
                                <a href="{{route('dynamic-invoice.create')}}" class="btn btn-primary">Create New Invoice</a>
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
                                            <th class="text-center">No</th>
                                            <th>Cat Name</th>
                                            <th>Vet Name</th>
                                            <th>Invoice Note</th>
                                            <th class="text-center">Net</th>
                                            <th class="text-center">VAT</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Invoice Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($invoice[0]))
                                        @foreach ($invoice as $key => $invoicee)
                                            <tr id="appid_{{$invoicee->id}}">
                                            
                                                <td class="text-center">{{ $key + 1 + ($invoice->currentPage() - 1) * $invoice->perPage() }} </td>
                                                <td>{{ $invoicee->cat_name }} </td>
                                                <td>{{ $invoicee->vet->name }} </td>
                                                <td>{{ $invoicee->invoice_note }} </td>
                                                <td class="text-center">{{ $invoicee->net }} </td>
                                                <td class="text-center">{{ $invoicee->vat }} </td>
                                                <td class="text-center">{{ $invoicee->total }} </td>
                                                <td class="text-center">{{ $invoicee->invoice_date }} </td>
                                                <td class="text-center">
                                                    <a href="{{ route('dynamic-invoice.view', $invoicee->id) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-eye"></i>View</a>
                                                    <a href="{{ route('dynamic-invoice.edit', $invoicee->id) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-pen"></i>Edit</a>
                                                    <a href="#" onclick="deleteInvoice('{{$invoicee->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" class="px-1 btn btn-app"><i class="uil uil-trash"></i>Delete</a>
                                                </td>

                                            </tr>

                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">
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
                                    {{ $invoice->appends(request()->input())->links('pagination::bootstrap-5') }}
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

</style>
@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script >

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#invoiceTable').DataTable(); 
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
                    url: "{{ route('dynamic-invoice.delete')}}",
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