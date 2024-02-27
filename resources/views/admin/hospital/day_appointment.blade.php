<div class="table-responsive">
    <div class="fc-header-toolbar fc-toolbar fc-custom-toolbar fc-toolbar-ltr">
        <div class="fc-toolbar-chunk">
            <div class="fc-button-group fc-button-group-custom">
                <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                    onclick="previousDay('{{ $date }}')" type="button" aria-label="prev">
                    <span class="fc-icon fc-icon-custom fc-icon-chevron-left"></span>
                </button>
                <button class="fc-next-button fc-next-button-custom fc-button fc-button-primary"
                    onclick="nextDay('{{ $date }}')" type="button" aria-label="next">
                    <span class="fc-icon fc-icon-custom fc-icon-chevron-right"></span>
                </button>
            </div>
        </div>
        <div class="fc-toolbar-chunk">
            <h2 class="fc-toolbar-title">{{ date('M d, Y', strtotime($date)) }}</h2>
        </div>
        <div class="fc-toolbar-chunk">
            <div class="fc-button-group fc-button-group-custom">
                <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                    onclick="getYearCalendar(`{{date('m')}}`,`{{date('Y')}}`)" id="y_view" type="button" aria-label="prev">
                    Year
                </button>
                <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                    onclick="reloadCalendar(`{{ date('Y-m-d') }}`)" id="month_view" type="button" aria-label="prev">
                    Month
                </button>
                <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                    onclick="getDayCalendar(`{{ date('Y-m-d') }}`)" id="month_view" type="button" aria-label="prev">
                    Day
                </button>
            </div>
        </div>
    </div>
    <h3 class="text-center"></h3>
    <!-- <table class="table table-bordered " id="dayTable">
        <thead>
            <tr>
                <th class="fit"></th>
                @if ($vets)
                    @foreach ($vets as $vet)
                        <th class="fit vet-name">{{ $vet->name }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($timeslots)
                @foreach ($timeslots as $slot)
                    <tr>
                        <th class="fit">{{ $slot }}</th>
                        @foreach ($vets as $vet)
                            @if (isset($vetSlots[$vet->id]) && in_array($slot, $vetSlots[$vet->id]))
                                @if (isset($vetBooks[$vet->id]) && in_array($slot, $vetBooks[$vet->id]))
                                    <td class="fit appointment-red app-disabled">
                                        <span><b>Caretaker : </b>{{ $details[$slot]['caretaker'] }} </span> &nbsp;
                                        <span><b>Cat :</b> {{ $details[$slot]['cat'] }}</span>
                                    </td>
                                @else
                                    <td class="fit appointment-green "  id="vet-{{ $vet->id }}" data-slot="{{ $slot }}" id="appointment-create"
                                        onclick="getAppointmentForm('{{ $date }}',['{{ $slot }}'],'{{ $vet->id }}')">
                                    </td>
                                @endif
                            @else
                                <td class="fit app-disabled"></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table> -->
    <!-- <div class="header d-flex justify-content-sm-around ">
        <input type="hidden" id="select-result"/>
        <div>Time</div>
        @if ($vets)
            @foreach ($vets as $vet)
                <div class="vet-name">{{ $vet->name }}</div>
            @endforeach
        @endif
    </div> -->
    <div class="table-con d-flex custom-schedule">
        <div class="time-col">
            @if ($timeslots)
                <div class="vet-name">Time</div>
                @foreach ($timeslots as $slot)
                    <div class="fit">{{ $slot }}</div>
                @endforeach
            @endif
        </div>
        @if ($vets)
            @foreach ($vets as $vet)
                
                <div class="vetselect" id="vet-div-{{ $vet->id }}">
                    <div class="vet-name">{{ $vet->name }}</div>
                    @foreach ($timeslots as $slot)
                        @if (isset($vetSlots[$vet->id]) && in_array($slot, $vetSlots[$vet->id]))
                            @if (isset($vetBooks[$vet->id]) && in_array($slot, $vetBooks[$vet->id]))
                                <div class="fit appointment-red app-disabled">
                                    <span><b>Caretaker : </b>{{ $details[$slot]['caretaker'] }} </span> 
                                    <br>
                                    <span><b>Cat :</b> {{ $details[$slot]['cat'] }}</span>
                                </div>
                            @else
                                <div class="fit appointment-green" data-slot="{{ $slot }}" id="appointment-create"
                                    onclick="getAppointmentForm('{{ $date }}',['{{ $slot }}'],'{{ $vet->id }}')">
                                    
                                </div>
                            @endif
                        @else
                            <div class="fit app-disabled"></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

</div>
<script>
    function sort() {
        @foreach ($vets as $vet)
            $("#vet-div-{{ $vet->id }}").selectable({
            filter: '.appointment-green',
            distance: 30,
            start: function() {
                $(".vetselect").find('.ui-selected').removeClass('ui-selected');
			},
            stop: function() {
				var result = [];
                $( "#select-result" ).val('');
				$( ".ui-selected").each(function() {
                    var slot = $.trim($(this).attr('data-slot'));
					result.push(slot);
				});
                $( "#select-result" ).val(result);
                getAppointmentForm('{{ $date }}',result,'{{ $vet->id }}')
			}
        });
        @endforeach
        // $("#dayTable").selectable({
        //     filter: '.appointment-green',
        //     distance: 30,
            
        //     stop: function() {
		// 		var result = [];
        //         $( "#select-result" ).val('');
		// 		$( ".ui-selected").each(function() {
        //             var slot = $(this).attr('data-slot');
		// 			result.push(slot);
		// 		});
        //         $( "#select-result" ).val(result);
		// 	}
        // });
    }
</script>
