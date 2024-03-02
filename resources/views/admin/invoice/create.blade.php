@extends('admin.layouts.app', ['body_class' => '', 'title' => 'New Invoice'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">
                            @if(isset($invoice->id))
                                Edit Custom Invoice
                            @else
                                Create New Custom Invoice
                            @endif
                        </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('invoice.index') }}">Custom Invoices</a>
                            </li>

                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('invoice.index') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                </div>
            </div>
        </div>
        
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4">
                        @if(session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <form name="frm" id="saveCustomInvoice" action="{{ route('invoice.store') }}" enctype="multipart/form-data"  method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <input type="hidden" name="invoice_id" id="invoice_id" value="{{ (isset($invoice->id) ? $invoice->id : '') }}">
                                    <label for="Name" class="col-form-label"><b>Vet Name</b> <span class="required">*</span></label>
                                    <select class="form-control" name="vet_name"  id="vet_name">
                                        <option value="">Select a vet </option>
                                        @foreach($vets as $vet)
                                            <option value="{{ $vet->id }}" {{ (isset($invoice->user_type) && $invoice->user_type == $vet->id ? 'selected' : '') }} > {{ $vet->name }} </option>
                                        @endforeach
                                    </select>   
                                    @error('vet_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Cat Name</b> <span class="required">*</span></label>
                                    <input class="form-control" name="cat_name" value="{{ old('cat_name',(isset($invoice->cat_name) ? $invoice->cat_name : '')) }}" type="text" placeholder="Enter cat name" id="cat_name">
                                    @error('cat_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label class="col-form-label col-md-2 col-sm-2 label-align"><b>Contents</b></label>
                                    <div class="col-md-12 col-sm-12" style="border: 1px solid #ced4da;    border-bottom: none;">
                                        <table class="table " >
                                            <tbody id="qn_table">
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Total Net</b> <span class="required">*</span></label>
                                    <input class="form-control" name="total_net" value="{{ old('total_net',(isset($invoice->net) ? $invoice->net : '')) }}" type="text" placeholder="Enter total net" id="total_net">
                                    @error('total_net')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Total VAT</b> <span class="required">*</span></label>
                                    <input class="form-control" name="total_vat" value="{{ old('total_vat',(isset($invoice->vat) ? $invoice->vat : '')) }}" type="text" placeholder="Enter total vat" id="total_vat">
                                    @error('cat_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Total Service Charge</b> <span class="required">*</span></label>
                                    <input class="form-control" name="total_service" value="{{ old('total_service',(isset($invoice->service_charge) ? $invoice->service_charge : '')) }}" type="text" placeholder="Enter total service charge" id="total_service">
                                    @error('total_service')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Grand Total</b> <span class="required">*</span></label>
                                    <input class="form-control" name="grand_total" value="{{ old('grand_total',(isset($invoice->total) ? $invoice->total : '')) }}" type="text" placeholder="Enter grand total" id="grand_total">
                                    @error('grand_total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Invoice Note</b> </label>
                                    <textarea class="form-control" rows="5"  name="invoice_note" id="invoice_note"> {{ old('invoice_note',(isset($invoice->invoice_note) ? $invoice->invoice_note : '')) }}</textarea>
                                </div>

                                
                                <div class="col-md-8 offset-md-2 mt-4">
                                    <div class="">
                                        <button name="Submit" type="Submit"  class="btn btn-primary waves-effect waves-light w-xl me-2">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection
@push('header')
<style>
.ck-editor__editable_inline {
    height: 500px;
}
.table>:not(caption)>*>* {
    border-bottom-width: 0;
    border-top-width: 0px;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">

    var count = 1;
    dynamic_field(count);

    function dynamic_field(number)
    {
        html = `<tr class="tr_`+number+`">
                    <td style="display:flex;">
                        <div class="col-md-6 col-sm-6">
                            <label for="Name" class="col-form-label"><b>Service</b> <span class="required">*</span></label>
                            <input class="form-control procedure_field" name="procedure[]" value="{{ old('procedure') }}" type="text" placeholder="Enter Service" data-id="`+number+`" id="procedure_`+number+`">
                        </div>
                        <div class="col-md-2 col-sm-2 ml-1">
                            <label for="Name" class="col-form-label"><b>Quantity</b> <span class="required">*</span></label>
                            <input class="form-control quantity_field" name="quantity[]" value="{{ old('quantity') }}" type="text" placeholder="Enter Quantity" data-id="`+number+`" id="quantity_`+number+`">
                        </div>
                        <div class="col-md-2 col-sm-2 ml-1">
                            <label for="Name" class="col-form-label"><b>Unit Price</b> <span class="required">*</span></label>
                            <input class="form-control price_field" name="price[]" value="{{ old('price') }}" type="text" placeholder="Enter Unit Price" data-id="`+number+`" id="price_`+number+`">
                        </div>
                       
                    </td>
                </tr>
                <tr class="tr_`+number+`" style="border-bottom: 1px solid #ced4da;">
                    <td style="display:flex;">    
                        <div class="col-md-3 col-sm-3">
                            <label for="Name" class="col-form-label"><b>Net</b> <span class="required">*</span></label>
                            <input class="form-control net_field" name="net[]" value="{{ old('net') }}" type="text" placeholder="Enter Net" data-id="`+number+`" id="net_`+number+`">
                        </div>
                        <div class="col-md-3 col-sm-3 ml-1">
                            <label for="Name" class="col-form-label"><b>Service Charge</b> <span class="required">*</span></label>
                            <input class="form-control service_charge_field" name="service_charge[]" value="{{ old('service_charge') }}" type="text" placeholder="Enter Service Charge" data-id="`+number+`" id="service_charge_`+number+`">
                        </div>
                        <div class="col-md-2 col-sm-2 ml-1">
                            <label for="Name" class="col-form-label"><b>VAT</b> <span class="required">*</span></label>
                            <input class="form-control vat_field" name="vat[]" value="{{ old('vat') }}" type="text" placeholder="Enter VAT" data-id="`+number+`" id="vat_`+number+`">
                        </div>
                        
                        <div class="col-md-2 col-sm-2 ml-1">
                            <label for="Name" class="col-form-label"><b>Total</b> <span class="required">*</span></label>
                            <input class="form-control total_field" name="total[]" value="{{ old('total') }}" type="text" placeholder="Enter Total" data-id="`+number+`" id="total_`+number+`">
                        </div>`;
            
            if(number > 1)
            {
                html += '<div class="col-md-2 col-sm-2 ml-1 div-center"> <button type="button" name="remove" data-id="'+number+'" data-id="'+number+'"  id="" class="btn btn-danger remove">Remove</button> </div></td> </tr> <hr>`;';
                $('#qn_table').append(html);
            }
            else
            {   
                html += '<div class="col-md-2 col-sm-2 ml-1 div-center"> <button type="button" name="add" id="add" class="btn btn-success">Add</button> </div></td></tr> <hr>';
                $('#qn_table').html(html);
            }
        
    }

    $(document).on('click', '#add', function(){
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function(){
        var button_id = $(this).attr("data-id");
        count--;
        $('.tr_'+button_id).remove();
        updateTotalFields();
    });

    function updateTotalFields(){
        var total_net = 0;
        $(".net_field").each(function(){
            total_net += +$(this).val();
        });
        $("#total_net").val(total_net);

        var total_vat = 0;
        $(".vat_field").each(function(){
            total_vat += +$(this).val();
        });
        $("#total_vat").val(total_vat);

        var total_service_charge = 0;
        $(".service_charge_field").each(function(){
            total_service_charge += +$(this).val();
        });
        $("#total_service").val(total_service_charge);

        var grand_total = 0;
        $(".total_field").each(function(){
            grand_total += +$(this).val();
        });
        $("#grand_total").val(grand_total);
    }

    $(document).on('keyup','.quantity_field', function() {
        var id = $(this).data('id');

        var quantity = parseFloat($(this).val());
        quantity = quantity ? quantity :0;
        var net = parseFloat($('#net_'+id).val());
        net = net ? net :0;
        var price = parseFloat($('#price_'+id).val());
        price = price ? price :0;
        var service_charge = parseFloat($('#service_charge_'+id).val());
        service_charge = service_charge ? service_charge :0;
        var vat = parseFloat($('#vat_'+id).val());
        vat = vat ? vat :0;

        net = quantity * price;
        vat = (net/100)*5;
        var total = net + service_charge + vat;

        $('#total_'+id).val(total);
        $('#vat_'+id).val(vat);
        $('#net_'+id).val(net);

        updateTotalFields();

    });

    $(document).on('keyup','.price_field', function() {
        var id = $(this).data('id');

        var price = parseFloat($(this).val());
        price = price ? price :0;

        var quantity = parseFloat($('#quantity_'+id).val());
        quantity = quantity ? quantity :0;


        var net = parseFloat($('#net_'+id).val());
        net = net ? net :0;
        
        var service_charge = parseFloat($('#service_charge_'+id).val());
        service_charge = service_charge ? service_charge :0;
        var vat = parseFloat($('#vat_'+id).val());
        vat = vat ? vat :0;

        net = quantity * price;
        vat = (net/100)*5;
        var total = net + service_charge + vat;

        $('#total_'+id).val(total);
        $('#vat_'+id).val(vat);
        $('#net_'+id).val(net);
        updateTotalFields();
    });

    $(document).on('keyup','.net_field', function() {
        var id = $(this).data('id');

        var net = parseFloat($(this).val());
        net = net ? net :0;

        var service_charge = parseFloat($('#service_charge_'+id).val());
        service_charge = service_charge ? service_charge :0;
        var vat = parseFloat($('#vat_'+id).val());
        vat = vat ? vat :0;

       
        vat = (net/100)*5;
        var total = net + service_charge + vat;

        $('#total_'+id).val(total);
        $('#vat_'+id).val(vat);
        updateTotalFields();
    });

    $(document).on('keyup','.service_charge_field', function() {
        var id = $(this).data('id');

        var service_charge = parseFloat($(this).val());
        service_charge = service_charge ? service_charge :0;

        var net = parseFloat($('#net_'+id).val());
        net = net ? net :0;

        var vat = parseFloat($('#vat_'+id).val());
        vat = vat ? vat :0;

        var total = net + service_charge + vat;

        $('#total_'+id).val(total);
        updateTotalFields();
    });

    $(document).on('keyup','.vat_field', function() {
        var id = $(this).data('id');

        var vat = parseFloat($(this).val());
        vat = vat ? vat :0;

        var service_charge = parseFloat($('#service_charge_'+id).val());
        service_charge = service_charge ? service_charge :0;

        var net = parseFloat($('#net_'+id).val());
        net = net ? net :0;

        var total = net + service_charge + vat;
        $('#total_'+id).val(total);

        updateTotalFields();
    });

    $(document).on('keyup','.total_field', function() {
        updateTotalFields();
    });

    $("#saveCustomInvoice").validate({
        rules: {
            'vet_name': 'required',
            'cat_name': 'required',
            'procedure[]': 'required',
            'quantity[]': 'required',
            'price[]': 'required',
            'net[]': 'required',
            'service_charge[]': 'required',
            'vat[]': 'required',
            'total[]': 'required',
            'total_net': 'required',
            'total_vat': 'required',
            'total_service': 'required',
            'grand_total': 'required',
        },
        messages: {
            
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2')) {
                error.insertAfter(element.next('.select2-container'));
            }else{
                error.appendTo(element.parent("div"));
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
@endpush