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
                <div class="d-flex justify-content-between g-">
                    <a href="{{ route('cat.view', $cat) }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row mt-3 journal_page">
            <div class="col-md-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <a class="nav-link mb-2 active data_active" id="medical-history" onclick="getJournalData('medical_history')" role="button">Medical History</a>

                            <a class="nav-link mb-2 data_none" id="dental"  onclick="getJournalData('dental')" role="button">Dental</a>

                            <a class="nav-link mb-2 data_none" id="hospitalization" onclick="getJournalData('hospitalization')" role="button">Hospitalization</a>

                            <a class="nav-link mb-2 data_none" id="hotel" onclick="getJournalData('hotel')" role="button">Hotel</a>

                            <a class="nav-link mb-2 data_none" id="laboratory-test" onclick="getJournalData('laboratory_test')" role="button">Laboratory Test</a>

                            <a class="nav-link mb-2 data_none" id="laser" onclick="getJournalData('laser')" role="button">laser</a>

                            <a class="nav-link mb-2 data_none" id="medicine" onclick="getJournalData('medicine')" role="button">Medicine</a>

                            <a class="nav-link mb-2  data_active" id="medical-treatment" onclick="getJournalData('medical_treatment')" role="button">Medical Treatment</a>

                            <a class="nav-link mb-2 data_none" id="surgery" onclick="getJournalData('surgery')" role="button">Surgery</a>

                            <a class="nav-link mb-2 data_none" id="ultrasound" onclick="getJournalData('ultrasound')" role="button">Ultrasound</a>

                            <a class="nav-link mb-2 data_none" id="virus-test" onclick="getJournalData('virus_test')" role="button">Virus Test</a>

                            <a class="nav-link mb-2 data_none" id="xray" onclick="getJournalData('xray')" role="button">X-ray</a>
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
@endpush

@push('scripts')
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
     $( "#date" ).datepicker({
        format: 'yyyy-mm-dd',
        dropdownParent: $('#createMedicalHistory'),
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getJournalData(type){
        $.ajax({
            url: "{{ route('cat.journal-data') }}",
            type: "POST",
            data: { type:type },
            success: function( response ) {
               $('#journal_data').html(response);
            }
        });
    }

</script>
@endpush