@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Cat Details'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Journal</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Journal</li>
                        </ol>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-40">
                        <div class="hstack gap-2">
                            <input class="form-control me-auto border-0" type="text" id="search" placeholder="Search..">
                            <button type="button" class="btn btn_back waves-effect waves-light w-md"  onclick="getJournalData('vital', '{{ $cat->id }}')">Search</button>
                            <button type="button" class="btn btn_back waves-effect waves-light w-md" id="searchReset">Reset</button>
                        </div>
                    </div>

                    <div class="btn_group">
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                            <input type="text" class="form-control text-start" placeholder="From" name="From" id="search_from_date">
                            <input type="text" class="form-control text-start" placeholder="To" name="To" id="search_to_date">
                            <button type="button" class="btn btn-primary" id="dateFilter" onclick="getJournalData('vital', '{{ $cat->id }}')"><i  class="fa fa-search"></i></button>
                            <button type="button" class="btn btn-primary" id="resetDateFilter" ><i  class="fa fa-sync"></i></button>
                        </div>
                       
                    </div>
                    <a href="{{ URL::previous() }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row mt-3 journal_page">
            <div class="col-md-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills menus" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <a class="nav-link mb-2 {{ isset($counts['vital']) ? 'data_active' : 'data_none' }}" id="vital" onclick="getJournalData('vital','{{ $cat->id }}')" role="button">Vitals</a>

                            <a class="nav-link mb-2 {{ isset($counts['med_history']) ? 'data_active' : 'data_none' }}" id="med_history" onclick="getJournalData('med_history','{{ $cat->id }}')" role="button">Medical History</a>

                            <a class="nav-link mb-2 {{ isset($counts['dental']) ? 'data_active' : 'data_none' }}" id="dental"  onclick="getJournalData('dental','{{ $cat->id }}')" role="button">Dental</a>

                            <a class="nav-link mb-2 {{ isset($counts['hospitalization']) ? 'data_active' : 'data_none' }}" id="hospitalization" onclick="getJournalData('hospitalization','{{ $cat->id }}')" role="button">Hospitalization</a>

                            <a class="nav-link mb-2 {{ isset($counts['hotel']) ? 'data_active' : 'data_none' }}" id="hotel" onclick="getJournalData('hotel','{{ $cat->id }}')" role="button">Hotel</a>

                            <a class="nav-link mb-2 {{ isset($counts['laboratory_test']) ? 'data_active' : 'data_none' }}" id="laboratory_test" onclick="getJournalData('laboratory_test','{{ $cat->id }}')" role="button">Laboratory Test</a>

                            <a class="nav-link mb-2 {{ isset($counts['laser']) ? 'data_active' : 'data_none' }}" id="laser" onclick="getJournalData('laser','{{ $cat->id }}')" role="button">Laser</a>

                            <a class="nav-link mb-2 {{ isset($counts['medicine']) ? 'data_active' : 'data_none' }}" id="medicine" onclick="getJournalData('medicine','{{ $cat->id }}')" role="button">Medicine</a>

                            <a class="nav-link mb-2 {{ isset($counts['medical_treatment']) ? 'data_active' : 'data_none' }}" id="medical_treatment" onclick="getJournalData('medical_treatment','{{ $cat->id }}')" role="button">Medical Treatment</a>

                            <a class="nav-link mb-2 {{ isset($counts['surgery']) ? 'data_active' : 'data_none' }}" id="surgery" onclick="getJournalData('surgery','{{ $cat->id }}')" role="button">Surgery</a>

                            <a class="nav-link mb-2 {{ isset($counts['ultrasound']) ? 'data_active' : 'data_none' }}" id="ultrasound" onclick="getJournalData('ultrasound','{{ $cat->id }}')" role="button">Ultrasound</a>

                            <a class="nav-link mb-2 {{ isset($counts['virus_test']) ? 'data_active' : 'data_none' }}" id="virus_test" onclick="getJournalData('virus_test','{{ $cat->id }}')" role="button">Virus Test</a>

                            <a class="nav-link mb-2 {{ isset($counts['xray']) ? 'data_active' : 'data_none' }}" id="xray" onclick="getJournalData('xray','{{ $cat->id }}')" role="button">X-ray</a>

                            <a class="nav-link mb-2 {{ isset($counts['forms']) ? 'data_active' : 'data_none' }}" id="forms" onclick="getJournalData('forms','{{ $cat->id }}')" role="button">Forms</a>

                            <a class="nav-link mb-2 {{ isset($counts['prescriptions']) ? 'data_active' : 'data_none' }}" id="prescriptions" onclick="getJournalData('prescriptions','{{ $cat->id }}')" role="button">Prescriptions</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="journal_data">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('header')
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.7.0/bootstrap-lightbox.min.css">
<style>
    /* The grid: Four equal columns that floats next to each other */
    .column {
    float: left;
    width: 25%;
    padding: 10px;
    }

    /* Style the images inside the grid */
    .column img {
    opacity: 0.8;
    cursor: pointer;
    }

    .column img:hover {
    opacity: 1;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    /* The expanding image container (positioning is needed to position the close button and the text) */
    .container {
    position: relative;
    display: none;
    }

    /* Expanding image text */
    #imgtext {
    position: absolute;
    bottom: 15px;
    left: 15px;
    color: white;
    font-size: 20px;
    }

    /* Closable button inside the image */
    .closebtn {
    position: absolute;
    top: 10px;
    right: 15px;
    color: white;
    font-size: 35px;
    cursor: pointer;
    }
    .lightbox{
      z-index: 1041;
    }
    .small-img{
      width: 100px;height: 100px;
    }
    .ck-editor__editable_inline {
        height: 280px;
    }
    .control-label .text-info { display:inline-block; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script>
    let cat_id = '{{ $cat->id }}';
    window.editor = '';
     $( "#date" ).datepicker({
        format: 'yyyy-mm-dd',
        dropdownParent: $('#createMedicalHistory'),
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   
    getJournalData('vital', cat_id);
    function getJournalData(type, cat_id){
        var keyword = $('#search').val();
        var from_date = $('#search_from_date').val();
        var to_date = $('#search_to_date').val();
    
        $.ajax({
            url: "{{ route('cat.journal-data') }}",
            type: "POST",
            data: { type : type , cat_id : cat_id, keyword :keyword,from_date:from_date,to_date:to_date},
            success: function( response ) {
                $('#journal_table').DataTable().clear();
                $('#journal_table').DataTable().destroy();
               $('#journal_data').html(response);
               $('#journal_table').DataTable();  
            //    $('.menus .nav-link').removeClass('data_active');
            //    $('.menus .nav-link').addClass('data_none');
            //    $('#'+type).addClass('data_active');
            //    $('#'+type).removeClass('data_none');
            }
        });
    }

    function deleteMedicalHistory(med_id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = []
                $.ajax({
                    url: "{{ route('delete-medical-history')}}",
                    type: "POST",
                    data: { med_id:med_id },
                    success: function( response ) {
                        $('#medid_'+med_id).css('background','#f9a8a8');
                        $('#medid_'+med_id).fadeOut(900,function(){
                            $(this).remove();
                        });
                        if(response == 0){
                            $('#vital').removeClass('data_active');
                            $('#vital').addClass('data_none');
                        }
                        
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


    function addMedicalHistory(){
        $('#error_medical').addClass('hide');
        var inputcheck = $("#createMedicalHistory input").filter(function () {
                            return $.trim($(this).val()).length == 0
                        }).length;
        if($.trim($('#blood_pressure').val()).length == 0 && $.trim($('#weight').val()).length == 0 && $.trim($('#temperature').val() ).length == 0 ){
            $('#error_medical').removeClass('hide');
        }else{
            var data = new FormData($('#createMedicalHistory')[0]);
            $.ajax({
                url: "{{ route('medical-history.store')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        'Medical history added successfully!',
                        'success'
                    );
                    $("#createMedicalHistory")[0].reset();
                    $('#error_medical').addClass('hide');
                    $('.med_history').modal('hide');
                    $('#vital').addClass('data_active');
                    $('#vital').removeClass('data_none');
                    getJournalData('vital', cat_id);
                }
            });
        }

    }

    function addJournalDetails(title,type){
        $('#error_heading').addClass('hide');
        var check = $.trim($('#heading').val()).length;
        if(check == 0){
            $('#error_heading').removeClass('hide');
        }else{
            var data = new FormData($('#createJournalData')[0]);
            $.ajax({
                url: "{{ route('journal-details.store')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        ' '+title+' details added successfully!',
                        'success'
                    );
                    $("#createJournalData")[0].reset();
                    $('#error_details').addClass('hide');
                    $('.journal_data').modal('hide');
                    $('#'+type).addClass('data_active');
                    $('#'+type).removeClass('data_none');
                    getJournalData(type, cat_id); 
                }
            });
        }
    }

    function addJournalPrescriptionDetails(title,type){
        $('#error_heading_pre').addClass('hide');
        var check = $.trim($('#heading_pre').val()).length;
        alert(check);
        if(check == 0){
            $('#error_heading_pre').removeClass('hide');
        }else{
            var data = new FormData($('#createPrescriptionJournalData')[0]);
            $.ajax({
                url: "{{ route('journal-prescription-details.store')}}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function( response ) {
                    Swal.fire(
                        '',
                        ' '+title+' details added successfully!',
                        'success'
                    );
                    $("#createPrescriptionJournalData")[0].reset();
                    $('#error_heading_pre').addClass('hide');
                    $('.journal_prescription_data').modal('hide');
                    $('#'+type).addClass('data_active');
                    $('#'+type).removeClass('data_none');
                    getJournalData(type, cat_id); 
                }
            });
        }
    }

    function deleteJournalData(jid){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = []
                $.ajax({
                    url: "{{ route('delete-journal-data')}}",
                    type: "POST",
                    data: { jid:jid },
                    success: function( response ) {
                        var resData = JSON.parse(response);
                        console.log(resData);
                        $('#dataid_'+jid).css('background','#f9a8a8');
                        $('#dataid_'+jid).fadeOut(900,function(){
                            $(this).remove();
                        });
                        if(resData.count == 0){
                            $('#'+resData.type).removeClass('data_active');
                            $('#'+resData.type).addClass('data_none');
                        }
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

    function addVirusTest(){
        var data = new FormData($('#createVirusTest')[0]);
        $.ajax({
            url: "{{ route('virus-test.store')}}",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function( response ) {
                Swal.fire(
                    '',
                    'Medical history added successfully!',
                    'success'
                );
                $("#createVirusTest")[0].reset();
                $('.virus_test').modal('hide');
                $('#virus_test').addClass('data_active');
                $('#virus_test').removeClass('data_none');
                getJournalData('virus_test', cat_id);
            }
        });
    }

    function deleteVirusTest(vid){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = []
                $.ajax({
                    url: "{{ route('delete-virus-test')}}",
                    type: "POST",
                    data: { vid:vid },
                    success: function( response ) {
                        $('#virusid_'+vid).css('background','#f9a8a8');
                        $('#virusid_'+vid).fadeOut(900,function(){
                            $(this).remove();
                        });
                        if(response == 0){
                            $('#virus_test').removeClass('data_active');
                            $('#virus_test').addClass('data_none');
                        }
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

    function getJournalImages(files){
        var result = files.split(',');
        var html = '';
        $.each(result, function(index1, value1) {
            var fileExt =  value1.substr( (value1.lastIndexOf('.') +1) );
          
            console.log(fileExt);
            switch(fileExt) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'bmp':
                case 'gif':
                    html += ' <div class="column"> <img src="'+value1+'"  style="width:80%;height: 80%;" onclick="myFunction(`'+value1+'`,`image`);"> </div>'; // There's was a typo in the example where
                break;                         // the alert ended with pdf instead of gif.
                case 'pdf':
                    html += ' <div class="column"><img src="{{ asset("assets/images/PDF_file_icon.png") }}"  style="width:80%;height: 80%;" onclick="myFunction(`'+value1+'`,`pdf`);"></div>'; 
                break;
                case 'doc':
                case 'docx':
                    html += ' <div class="column"> <a href="'+value1+'" target="_blank" > <img src="{{ asset("assets/images/word_file_icon.png") }}"  style="width:80%;height: 80%;" > </a> </div>';
                break;  
                case 'txt':
                html += ' <div class="column"><img src="{{ asset("assets/images/txt-icon.png") }}"  style="width:80%;height: 80%;" onclick="myFunction(`'+value1+'`,`txt`);"></div>'; 
                break;  
                default:

            }
           
        });
        $('#ImageList').html(html);
        $('.images_data').modal('show');
    }
    function myFunction(src, type){
        var html = '';
        if(type == 'image'){
            html += '<img id="large-image" class="w-100 h-800" src="'+src+'" alt="">';
        }else if(type == 'pdf' || type == 'txt'){
            html += '<iframe id="large-image" class="w-100" style="min-height: 750px !important;" src="'+src+'" ></iframe>';
        }
        $("#image-show-area").html(html);
        $('#show_image_popup').modal('show');
    }

    $("#searchReset").on("click", function (e) { 
        $('#search').val('');
        getJournalData('vital', cat_id);
    });

    $("#resetDateFilter").on("click", function (e) { 
        $('#search_from_date,#search_to_date' ).datepicker( 'setDate', '' ).datepicker('fill');
        getJournalData('vital', cat_id);
    });

    function showAddModal (){
        if(editor){
            editor.destroy();
        }
        
        $('.journal_data').modal('show');
        ClassicEditor .create( document.querySelector( '#remark_content' ), {
            width:['250px'],
            tabSpaces:4,
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo' ],
            updateSourceElementOnDestroy:true,
            removePlugins: ["EasyImage","ImageUpload","MediaEmbed","blockquote"]
        } ).then(editor => {
                window.editor = editor;
                    editor.model.document.on('change:data', () => {
					    $('#remark_content').html(editor.getData());
                    })
               })
        .catch( error => {
            console.log( error );
        } );
    }

    function showPrescriptionAddModal (){
        if(editor){
            editor.destroy();
        }
        
        $('.journal_prescription_data').modal('show');
        ClassicEditor .create( document.querySelector( '#prescription_content' ), {
            width:['250px'],
            tabSpaces:4,
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo' ],
            updateSourceElementOnDestroy:true,
            removePlugins: ["EasyImage","ImageUpload","MediaEmbed","blockquote"]
        } ).then(editor => {
                window.editor = editor;
                    editor.model.document.on('change:data', () => {
					    $('#prescription_content').html(editor.getData());
                    })
               })
        .catch( error => {
            console.log( error );
        } );
    }

    function showModal(id){

        $.ajax({
            url: "{{ route('journal-details.view')}}",
            type: "POST",
            data: { id: id},
            success: function( response ) {
                $('#heading-data').html(response[0].heading);
                $('#content-data').html(response[0].remarks);
            
                $('#show_popup').modal('show');
            }
        });
    }

    function showFormModal(id){

        $.ajax({
            url: "{{ route('journal-form-details.view')}}",
            type: "POST",
            data: { id: id},
            success: function( response ) {
                $('#content-data').html(response);
                $('#show_popup').modal('show');
            }
        });
    }

    function createNames(type){
        var text = $('.'+type).text();
        var input = $('<input id="attribute_'+type+'" value="' + text + '" />');
        $('.'+type).text('').append(input);
        input.select();

        input.blur(function() {
            var text = $("#attribute_"+type).val();
            $('#attribute_'+type).parent().text(text);
            $('#text_'+type).val(text);
            $('#attribute_'+type).remove();
        });
    }

    function printElement(elem)
    {
        var  node = document.getElementById("pre-content-data");
        var domClone = node.cloneNode(true);

        var $printSection = document.getElementById("pre-content-data-new");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "pre-content-data-new";
            document.body.appendChild($printSection);
        }
  
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();


        // var mywindow = window.open('', 'PRINT', '');

        // // mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        // // mywindow.document.write('</head><body >');
        // // mywindow.document.write('<h1>' + document.title  + '</h1>');
        // mywindow.document.write(document.getElementById(elem).innerHTML);
        // // mywindow.document.write('</body></html>');

        // // mywindow.document.close(); // necessary for IE >= 10
        // // mywindow.focus(); // necessary for IE >= 10*/

        // mywindow.print();
        // mywindow.close();

        // return true;
    }

    function showPrescriptionModal(id){
        $.ajax({
            url: "{{ route('journal-pre-details.view')}}",
            type: "POST",
            data: { id: id},
            success: function( response ) {
                $('#pre-content-data').html(response);
                var html = '<a href="#" class="btn btn-primary px-3" onclick="printElement(`pre-content-data`)"><i class="uil uil-print"> Print</i></a>'+
                '<a href="#" class="btn btn-primary px-3" onclick="sendToMail()"><i class="uil uil-message"> Send To Mail</i></a>';
                $('.modal-footer').html(html);

                $('#show_prescription_popup').modal('show');
            }
        });
    }
   
</script>
@endpush