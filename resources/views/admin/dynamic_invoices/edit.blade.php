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
                                Edit Dynamic Invoice
                            @else
                                Create New Dynamic Invoice
                            @endif
                        </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('dynamic-invoice.index') }}">Dynamic Invoices</a>
                            </li>

                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('dynamic-invoice.index') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
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
                        <form name="frm" id="saveDynamicInvoice" action="{{ route('dynamic-invoice.store') }}" enctype="multipart/form-data"  method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="invoice_id" id="invoice_id" value="{{ (isset($invoice->id) ? $invoice->id : '') }}">
                                    <label for="Name" class="col-form-label"><b>Vet Name</b> <span class="required">*</span></label>
                                    <select class="form-control select2" name="vet_name"  id="vet_name">
                                        <option value="">Select a vet </option>
                                        @foreach($vets as $vet)
                                            <option value="{{ $vet->id }}" @if($invoice->vet_id == $vet->id) selected @endif> {{ $vet->name }} </option>
                                        @endforeach
                                    </select>   
                                </div>

                                <div class="col-md-12">
                                    <label for="Name" class="col-form-label"><b>Cat Name</b> <span class="required">*</span></label>
                                    <input class="form-control" name="cat_name" value="{{ old('cat_name', $invoice->cat_name) }}" type="text" placeholder="Enter cat name" id="cat_name">
                                </div>

                                <div class="col-md-12">
                                    <label class="col-form-label col-md-2 col-sm-2 label-align"><b>Contents</b></label>
                                    <div class="col-md-12 col-sm-12" style="border: 1px solid #ced4da;    border-bottom: none;">
                                        <table class="table " >
                                            <thead>
                                                <tr>
                                                    <td style="display:flex;margin: 0% 0% -2%;">
                                                        <div class="col-md-3 col-sm-4">
                                                            <label for="Name" class="col-form-label"><b>Price List Category</b> <span class="required">*</span></label>
                                                        </div>

                                                        <div class="col-md-3 col-sm-4">
                                                            <label for="Name" class="col-form-label"><b>Service/Product</b> <span class="required">*</span></label>
                                                        </div>
                                                        
                                                        <div class="col-md-1 col-sm-3 ml-1">
                                                            <label for="Name" class="col-form-label"><b>Unit Price</b> <span class="required">*</span></label>
                                                        </div>

                                                        <div class="col-md-2 col-sm-3">
                                                            <label for="Name" class="col-form-label"><b>Quantity</b> <span class="required">*</span></label>
                                                        </div>
                                
                                                        <div class="col-md-2 col-sm-3">
                                                            <label for="Name" class="col-form-label"><b>Total</b> <span class="required">*</span></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id="qn_table">
                                                @foreach( $invoice->dynamic_invoice_details as $key => $inv)

                                                    @php
                                                        $services = Helper::getCategoryServicesList($inv->category_id);
                                                    @endphp
                                                    <tr class="tr_{{$key}}">
                                                        <td >
                                                            <div class="row">

                                                                <div class="col-md-3 col-sm-4">
                                                                    <select class="form-select form-control select2 category_field" data-id="{{$key}}" name="category[]" id="category_{{$key}}">
                                                                        @foreach ($categories as $cate)
                                                                        <option value="{{ $cate['id'] }}" @if($cate['id'] == $inv->category_id)  selected @endif >{{ $cate['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 col-sm-4">
                                                                    <select class="form-select form-control select2 service_field" data-id="{{$key}}" name="service[]" id="service_{{$key}}">
                                                                        @foreach ($services as $serv)
                                                                        <option value="{{ $serv['id'] }}" @if($serv['id'] == $inv->service_id)  selected @endif data-price="{{$serv['price']}}">{{ $serv['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                        
                                                                <div class="col-md-1 col-sm-3">
                                                                    <input class="form-control price_field" name="price[]" value="{{$inv->unit_price}}" type="text" data-id="{{$key}}" id="price_{{$key}}" readonly>
                                                                </div>
                                        
                                                                <div class="col-md-2 col-sm-3">
                                                                    <input class="form-control quantity_field" name="quantity[]" value="{{$inv->quantity}}" type="number" step="1" min="0" placeholder="Enter Quantity" data-id="{{$key}}" id="quantity_{{$key}}">
                                                                </div>
                                        
                                                                <div class="col-md-2 col-sm-3">
                                                                    <input class="form-control total_field" name="total[]" value="{{ $inv->total }}" type="text" data-id="{{$key}}" id="total_{{$key}}" readonly>
                                                                </div>

                                                                <div class="col-md-1 col-sm-2 div-center">
                                                                    @if($key == 0)
                                                                        <button type="button" name="add" id="add" class="btn btn-success">Add</button>
                                                                    @else
                                                                        <button type="button" name="remove" data-id="{{$key}}" data-id="{{$key}}"  id="" class="btn btn-danger remove">Remove</button> 
                                                                    @endif
                                                                </div>
                                                            </div>
                                                          
                                                        </td> 
                                                    </tr> 
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="Name" class="col-form-label"><b>Net</b> <span class="required">*</span></label>
                                    <input class="form-control" name="total_net" value="{{ $invoice->net }}" type="text" placeholder="Enter total net" id="total_net" readonly>
                                </div>

                                <div class="col-md-12">
                                    <label for="Name" class="col-form-label"><b>VAT (5%)</b> <span class="required">*</span></label>
                                    <input class="form-control" name="total_vat" value="{{ $invoice->vat }}" type="text" placeholder="Enter total vat" id="total_vat" readonly>
                                </div>

                                <div class="col-md-12">
                                    <label for="Name" class="col-form-label"><b>Grand Total</b> <span class="required">*</span></label>
                                    <input class="form-control" name="grand_total" value="{{ $invoice->total }}" type="text" placeholder="Enter grand total" id="grand_total" readonly>
                                    @error('grand_total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="Name" class="col-form-label"><b>Invoice Note</b> </label>
                                    <textarea class="form-control" rows="5"  name="invoice_note" id="invoice_note">{{ $invoice->invoice_note }}</textarea>
                                </div>

                                
                                <div class="col-md-12 mt-4">
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

<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
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

<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">

    $('.select2').select2({
        placeholder: 'Select',
        // dropdownParent: $('#createAppointmentModal'),
        width: 'resolve', // need to override the changed default
        allowClear: false,
    });

    var category_options = [];
    category_options.push('<option value="">Select Pricelist Category</option>');   
    @foreach ($categories as $categ)
        category_options.push('<option value="{{ $categ['id'] }}" >{{ $categ['name'] }}</option>');      
    @endforeach

    var categoryDrop = category_options.join('');

    var count = {{$detailsCount}};
    
    function dynamic_field(number)
    {
        html = `<tr class="tr_`+number+`">
                    <td>
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <select class="form-select form-control select2 category_field" data-id="`+number+`" name="category[]" id="category_`+number+`">
                                    `+categoryDrop+`
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-4">
                                <select class="form-select form-control select2 service_field" data-id="`+number+`" name="service[]" id="service_`+number+`">
                                    
                                </select>
                            </div>

                            <div class="col-md-1 col-sm-3">
                                <input class="form-control price_field" name="price[]" value="0" type="text" data-id="`+number+`" id="price_`+number+`" readonly>
                            </div>

                            <div class="col-md-2 col-sm-3">
                                <input class="form-control quantity_field" name="quantity[]" value="" type="text" placeholder="Enter Quantity" data-id="`+number+`" id="quantity_`+number+`">
                            </div>

                            <div class="col-md-2 col-sm-3">
                                <input class="form-control total_field" name="total[]" value="0" type="text" data-id="`+number+`" id="total_`+number+`" readonly>
                            </div>
                     `;
            
            if(number > 1)
            {
                html += '<div class="col-md-1 col-sm-2 div-center"> <button type="button" name="remove" data-id="'+number+'" data-id="'+number+'"  id="" class="btn btn-danger remove">Remove</button> </div></div></td> </tr> <hr>`;';
                $('#qn_table').append(html);
            }
            else
            {   
                html += '<div class="col-md-1 col-sm-2 div-center"> <button type="button" name="add" id="add" class="btn btn-success">Add</button> </div></div></td></tr> <hr>';
                $('#qn_table').html(html);
            }
        $('.select2').select2({
            placeholder: 'Select',
            // dropdownParent: $('#createAppointmentModal'),
            width: 'resolve', // need to override the changed default
            allowClear: false,
        });
    }

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $(document).on('change', '.category_field', function() {
        var catfield_id = $(this).data('id');
        var categId = $(this).val();
        
        getServicesList(categId, catfield_id);
    });

    function getServicesList(categId, catfield_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('get-service-list')}}",
            type: "GET",
            data:  { 
                categ_id: categId
            },
            success: function( response ) {
                console.log('#service_'+catfield_id);
                $('#service_'+catfield_id).html(response).trigger('change');
            }
        });
    }
    

    $(document).on('change', '.service_field', function() {
        serviceData(this);
    });
    
    function serviceData(selectElement) {
        var field_id = $(selectElement).data('id');
        var selectedAttributeValue = $(selectElement).find('option:selected').data('price');
        console.log('Selected price value:', selectedAttributeValue);
        $('#price_'+field_id).val(selectedAttributeValue);

        var quantity = parseFloat($('#quantity_'+field_id).val());
        quantity = quantity ? quantity :0;
        
        var price = parseFloat(selectedAttributeValue);
        price = price ? price :0;
    
        var total = quantity * price;

        $('#total_'+field_id).val(total);
        updateTotalFields()
    }

    $(document).on('click', '#add', function(){
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function(){
        var button_id = $(this).attr("data-id");
        // count--;
        $('.tr_'+button_id).remove();
        updateTotalFields();
    });

    function updateTotalFields(){
        var total_net = 0;
        $(".total_field").each(function(){
            total_net += +$(this).val();
        });
        $("#total_net").val(total_net);
        
        var grand_total = 0;
        $(".total_field").each(function(){
            grand_total += +$(this).val();
        });
        var total_vat = grand_total *  0.05;
        total_vat = total_vat.toFixed(2);
        $("#grand_total").val(parseFloat(grand_total) +parseFloat( total_vat));

        $("#total_vat").val(total_vat);

    }

    $(document).on('keyup','.quantity_field', function() {
        var id = $(this).data('id');

        var quantity = parseFloat($(this).val());
        quantity = quantity ? quantity :0;
        
        var price = parseFloat($('#price_'+id).val());
        price = price ? price :0;
    
        var total = quantity * price;

        $('#total_'+id).val(total);
    
        updateTotalFields();

    });


    $("#saveDynamicInvoice").validate({
        rules: {
            'vet_name': 'required',
            'cat_name': 'required',
            'category[]': 'required',
            'service[]': 'required',
            'quantity[]': 'required',
            'price[]': 'required',
            'total[]': 'required',
            'total_net': 'required',
            'total_vat': 'required',
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