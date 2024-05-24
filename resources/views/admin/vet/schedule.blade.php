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
                <div class="d-flex justify-content-between">
                    <div class="search_warpper w-100" id="vetDropdownParent">
                        <div class="hstack gap-2 w-100">
                            <label class="w-41">Vet Name</label>
                            <label class="w-30"> Time</label>
                                
                        </div>

                    </div>    
                </div>
                <div class="d-flex justify-content-between mb-3">

                    
                    <div class="search_warpper w-100" id="vetDropdownParent">
                        <div class="hstack gap-2 w-100">
                          
                            <select class="form-select form-control select2 w-40"  id="vet_id" name="vet_id">
                                <!-- <option value="">Select a Vet</option> -->
                                @if($vets)
                                    @foreach($vets as $vet)
                                        <option value=" {{ $vet->id }}" data-value="{{ $vet->price }}"> {{ $vet->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                            
                            <input type="text" class="form-control w-30" name="daterange" id="daterange" value="" autocomplete="off" placeholder="00:00 - 00:00">
                            <input type="hidden" class="" name="from_time" id="from_time" value="">
                            <input type="hidden" class="" name="to_time" id="to_time" value="">

                            <button class="btn btn_back waves-effect waves-light w-md " id="scheduleVet">Update Schedule</button>
                            <button class="btn btn_back waves-effect waves-light w-md" id="saveVetSchedule">Save Time</button>
                        </div>
                        <input type="hidden" class="form-control" id="selectedDatesForAdd" value=""/>
                        <input type="hidden"  class="form-control" id="selectedDatesForRemove" value=""/>
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
                                <div id="year_appointment" style="display:none;"></div>
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
<link rel="stylesheet" href="{{ asset('assets/css/fullcalendar/main.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}" />

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

<style>
   .input-group{
    width: 40% !important;
   }
    .year_colum{
        font-weight : 700;
    }
    .fc-event-title {
        color: black !important;
        text-align: center; /* Center align the event title */
        font-weight: bold; 
        font-size: 13px !important;
    }

    .scheduled {
        top: 25% !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{ asset('assets/js/fullcalendar/main.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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

        $('#from_time').val('08:00');
        $('#to_time').val('21:00');

        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            timePicker: true,
            timePicker24Hour: false,
            timePickerIncrement: 30,
            timePickerSeconds: false,
            minDate: moment().startOf('day').hour(8).minute(0).second(0), // Set minimum date to today at 08:00 AM
            maxDate: moment().endOf('day').hour(22).minute(0).second(0),
            timePickerDefaultValue: null,
            cancelButtonClasses: 'clear-time',
            locale: {
                format: 'hh:mm A'
            },
        }, function(start, end, label) {
        
            $('#from_time').val(start.format('HH:mm'));
            $('#to_time').val(end.format('HH:mm'));
           
        }).on('show.daterangepicker', function (ev, picker) {
                    picker.container.find(".calendar-table").hide();
        });
        $('#daterange').val('');

        $(document).on('click', '.clear-time', function() {
            $('#daterange').val(''); // Clear the time input
        });

        getVetScheduleTime(vet_id);

        loadCalendar();
        function loadCalendar(){
           
            var url = '{{ route("get-vet-schedule", ":vet_id") }}';
                url = url.replace(':vet_id', vet_id);
        
            var calendarEl = document.getElementById('vet_schedule_calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: url,
                aspectRatio: 1.5,
                eventContent: function(arg) {
                    return {
                        html: '<div class="fc-event-title">' + arg.event.title + '</div>'
                    }
                },
                customButtons: {
                    customYear: {
                        text: 'Year',
                        click: function() {
                            var date = new Date();
                            var month = date.getMonth()+1;
                            month = (month.length<2 ? '0' : '') + month;
                            var year = date.getFullYear();
                            getYearCalendar(month, year);
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'customYear,dayGridMonth'
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

        function reloadCalendarFirst(date){ 
            $('#vet_schedule_calendar').css('display','block'); 
            $('#year_appointment').html('');
            calendar.gotoDate(date);
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
            var vetId           = $('#vet_id').val();
            var addDates        = $('#selectedDatesForAdd').val();
            var removeDates     = $('#selectedDatesForRemove').val();
            var from_time       = $('#from_time').val();
            var to_time         = $('#to_time').val();
            var daterange       = $('#daterange').val();

            var msg = '';
            var flag = true;
            if(vetId == '' || vetId == null || vetId == 'null'){
                msg = 'Please select a Vet!';
                flag = false;
            }
            // else if(daterange == ''){
            //     msg = 'Please select time!';
            //     flag = false;
            // }

            if(flag){
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
                        removeDates: removeDates,
                        from_time: from_time,
                        to_time : to_time,
                        daterange : daterange
                    },
                    success: function( response ) {
                        var returnedData = JSON.parse(response);
                        Swal.fire(
                            '',
                            returnedData.msg,
                            returnedData.status
                        );
                        if(returnedData.status != 'error'){
                            $('#selectedDatesForAdd').val('');
                            $('#selectedDatesForRemove').val('');
                            selectedDatesForAdd = [];
                            selectedDatesForRemove = [];
                        }
                        calendar.refetchEvents();
                    }
                });
            }else{
                Swal.fire(   '',
                            msg,
                            'warning'
                        );
            }
           
        });

        $("#saveVetSchedule").on("click", function (e) { 
        
            var vetId           = $('#vet_id').val();
            var from_time       = $('#from_time').val();
            var to_time         = $('#to_time').val();
            var daterange       = $('#daterange').val();

            var msg = '';
            var flag = true;
            if(vetId == '' || vetId == null || vetId == 'null'){
                msg = 'Please select a Vet!';
                flag = false;
            }else if(daterange == ''){
                msg = 'Please select time!';
                flag = false;
            }

            if(flag){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('save-vet-schedule-time')}}",
                    type: "POST",
                    data:  { 
                        vet_id: vetId, 
                        from_time: from_time,
                        to_time : to_time,
                        daterange : daterange
                    },
                    success: function( response ) {
                        var returnedData = JSON.parse(response);
                        Swal.fire(
                            '',
                            returnedData.msg,
                            returnedData.status
                        );
                    }
                });
            }else{
                Swal.fire('',  msg, 'warning');
            }
           
        });

        $("#vet_id").on("change", function () { 
            $('#selectedDatesForAdd').val('');
            $('#selectedDatesForRemove').val('');
            selectedDatesForAdd = [];
            selectedDatesForRemove = [];
            vet_id = $(this).val();

            getVetScheduleTime(vet_id);
        
            $('#vet_schedule_calendar').css('display','block'); 
            $('#year_appointment').html('');
            calendar.destroy();
            loadCalendar();
        });

        function getVetScheduleTime(vet_id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('get-vet-schedule-time')}}",
                type: "GET",
                data:  { 
                    vet_id: vet_id
                },
                success: function( response ) {
                    var returnedData = JSON.parse(response);
                    console.log(returnedData);

                    if(returnedData.from != '00:00' || returnedData.to !='00:00'){
                        resetDateRangePicker(returnedData.from, returnedData.to);
                    }else{
                        $('#daterange').val('');
                    }
                    
                    $('#from_time').val(returnedData.from);
                    $('#to_time').val(returnedData.to);
                }
            });
        }
        
        function resetDateRangePicker(startTime, endTime) {
            var formattedStartTime  = moment(startTime, 'hh:mm A').format('hh:mm A');
            var formattedEndTime    = moment(endTime, 'hh:mm A').format('hh:mm A');

            $('#daterange').data('daterangepicker').setStartDate(formattedStartTime);
            $('#daterange').data('daterangepicker').setEndDate(formattedEndTime);
        }
       
    });
    
    function reloadCalendar(date){ 
        $('#vet_schedule_calendar').css('display','block'); 
        $('#year_appointment').html('');
        calendar.gotoDate(date);
    }

    function nextYear(date){
        var nextYear = getNextYear(date);
        getYearCalendar('01',nextYear);
    }
    function previousYear(date){
        var preYear = getPreviousYear(date);
        getYearCalendar('01',preYear);
    }
    function getYearCalendar(month, year){
            var selectedDate = '';
            $.ajax({
                url: '{{ route("ajax-getyear-schedules") }}',
                type: "POST",
                data:  { "_token": "{{ csrf_token() }}", "month": month, "year" : year, "vet_id":vet_id},
                success: function( response ) {
                    $('#vet_schedule_calendar').css('display','none'); 
                    $('#year_appointment').html(response);
                    $('#year_appointment').css('display','block');
                }
            });
        }
    
</script>
@endpush