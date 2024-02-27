    <div class="table-responsive">
        <div class="fc-header-toolbar fc-toolbar fc-custom-toolbar fc-toolbar-ltr">
            <div class="fc-toolbar-chunk">
                <div class="fc-button-group fc-button-group-custom">
                    <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                        onclick="previousYear('{{ $year }}-01-01')" type="button" aria-label="prev">
                        <span class="fc-icon fc-icon-custom fc-icon-chevron-left"></span>
                    </button>
                    <button class="fc-next-button fc-next-button-custom fc-button fc-button-primary"
                        onclick="nextYear('{{ $year }}-01-01')" type="button" aria-label="next">
                        <span class="fc-icon fc-icon-custom fc-icon-chevron-right"></span>
                    </button>
                </div>
            </div>
            <div class="fc-toolbar-chunk">
                <h2 class="fc-toolbar-title">{{ $startMonthWord }}, {{ $year }} - {{ $endMonthWord }}, {{ $newYear }}</h2>
            </div>
            <div class="fc-toolbar-chunk">
                <div class="fc-button-group fc-button-group-custom">
                    <button class="fc-prev-button  fc-prev-button-custom fc-button fc-button-primary"
                        onclick="getYearCalendar(`{{date('m')}}`,`{{date('Y')}}`)" id="month_view" type="button" aria-label="prev">
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
        <div class="year_warpper">
            @if($result)
                @foreach($result as $res)
                @php $date = $res['year'].'-'.$res['month'].'-01'; @endphp
                    <div class="year_colum {{ ($res['vet'] != '') ? 'scheduled' : '' }}"  onclick="reloadCalendar('{{ $date }}')">
                        <h4> {{ $res['name'] }}</h4>
                        <p class="m-0 text-center"> {!! $res['vet'] !!}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
<script>
   
</script>
