@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Vets'])
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Vets Work Schedule </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Vets Work Schedule</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <div class="search_warpper w-30" id="vetDropdownParent">
                        <div class="hstack gap-2">
                            <select class="form-select form-control select2 "  id="vet_id" name="vet_id">
                                <!-- <option value="">Select a Vet</option> -->
                                @if($vets)
                                    @foreach($vets as $vet)
                                        <option value=" {{ $vet->id }}" data-value="{{ $vet->price }}"> {{ $vet->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                            <!-- <button type="button" class="btn btn_back waves-effect waves-light px-4">Select</button> -->
                        </div>
                        <input type="hidden" class="form-control" id="selectedDatesForAdd" value=""/>
                        <input type="hidden"  class="form-control" id="selectedDatesForRemove" value=""/>
                    </div>

                    <div class="btn_group">

                        <!-- <a href="#" class="btn btn_back waves-effect waves-light w-sm me-2">Export</a>
                        <a href="#" class="btn btn_back waves-effect waves-light w-sm me-2">Print</a> -->
                        <button class="btn btn_back waves-effect waves-light w-md" id="scheduleVet">Update Schedule</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="external-events">
                            <div class="card-body">
                                <div id="vet_schedule_calendar"></div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <div style='clear:both'></div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>

@endsection

@push('header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.css">
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.js"></script>
<script>
    $('#vet_id').select2({
        placeholder: 'Select Vet',
        // dropdownParent: $('#vetDropdownParent'),
        width: 'resolve', // need to override the changed default
        allowClear: true,
    });

    let vet_id = $('#vet_id').val();
    let selectedDatesForAdd = [];
    let selectedDatesForRemove = [];
    let calendar; 
    $(document).ready(function() {
      
        loadCalendar();
        function loadCalendar(){
           
            var url = '{{ route("get-vet-schedule", ":vet_id") }}';
                url = url.replace(':vet_id', vet_id);
        
            var calendarEl = document.getElementById('vet_schedule_calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: url,
                aspectRatio: 1.75,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                eventBackgroundColor:'#fff',
                textColor: 'black',
                editable: true,
                droppable: false, // this allows things to be dropped onto the calendar
                selectable: true,
                select: function (start, end, jsEvent, view) {
                    startDate = start.startStr;
                    endDate = getPreviousDay(start.endStr);
                    betweenDates = getDatesBetween(startDate, endDate);
                
                    $.each(betweenDates, function(index, value) {
                        var clickedDate = new Date(value);
                        var nowDate = getDateWithoutTime(new Date())
                        if (clickedDate >= nowDate){
                            if( $("td[data-date='"+value+"']").find('div.scheduled').length !== 0){
                                removeItem(value);
                                $("td[data-date='"+value+"']").find('div.scheduled').removeClass('scheduled');
                                $("td[data-date='"+value+"'] div:first").removeClass('date-highlight');
                                $("td[data-date='"+value+"'] div:first").addClass('schedule-removed');
                            }else if( $("td[data-date='"+value+"'] div:first").hasClass('date-highlight')){
                                removeItem(value);
                                $("td[data-date='"+value+"'] div:first").removeClass('date-highlight');
                            }else{
                                if( $("td[data-date='"+value+"']").find('div.scheduled').length == 0){
                                    
                                    $("td[data-date='"+value+"']").find('div.fc-bg-event').addClass('scheduled');
                                }
                                addItem(value);
                                $("td[data-date='"+value+"'] div:first").addClass('date-highlight');
                            }
                        }
                        
                    });
                
                    $('#selectedDatesForAdd').val(selectedDatesForAdd);
                    $('#selectedDatesForRemove').val(selectedDatesForRemove);
                },
                
            });

            calendar.render();
        }
        function addItem(value){
            var idx = $.inArray(value, selectedDatesForRemove);
            if (idx !== -1) {
                selectedDatesForRemove.splice(idx, 1);
            }
            selectedDatesForAdd.push(value);
        }

        function removeItem(value){
            var idx = $.inArray(value, selectedDatesForAdd);
            if (idx !== -1) {
                selectedDatesForAdd.splice(idx, 1);
            }
            selectedDatesForRemove.push(value);
        }

        $("#scheduleVet").on("click", function (e) { 
            var vetId          = $('#vet_id').val();
            var addDates        = $('#selectedDatesForAdd').val();
            var removeDates     = $('#selectedDatesForRemove').val();
            if(vetId != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('save-vet-schedule')}}",
                    type: "POST",
                    data:  { 
                        vet_id: vetId, 
                        addDates: addDates, 
                        removeDates: removeDates
                    },
                    success: function( response ) {
                        var returnedData = JSON.parse(response);
                        Swal.fire(
                            '',
                            returnedData.msg,
                            returnedData.status
                        );
                        $('#selectedDatesForAdd').val('');
                        $('#selectedDatesForRemove').val('');
                        selectedDatesForAdd = [];
                        selectedDatesForRemove = [];
                        calendar.refetchEvents()
                    }
                });
            }else{
                Swal.fire(   '',
                            'Please select a Vet!',
                            'warning'
                        );
            }
           
        });

        $("#vet_id").on("change", function () { 
            $('#selectedDatesForAdd').val('');
            $('#selectedDatesForRemove').val('');
            selectedDatesForAdd = [];
            selectedDatesForRemove = [];
            vet_id = $(this).val();
            calendar.destroy();
            loadCalendar();
        });
    });
    
   
    
</script>
@endpush