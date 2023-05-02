@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Manage Hospital Appointments'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Manage Hospital Appointments</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Hospital Appointments</li>
                        </ol>
                    </div>

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="search_warpper w-50">
                        <form>
                            <div class="hstack gap-2">
                                <input class="form-control me-auto border-0" type="search" placeholder="Search here">
                                <button type="button" class="btn btn_back waves-effect waves-light w-xl">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="btn_group">
                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy"
                            data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                            <input type="text" class="form-control text-start" placeholder="From" name="From">
                            <input type="text" class="form-control text-start" placeholder="To" name="To">
                            <button type="button" class="btn btn-primary"><i
                                    class="mdi mdi-filter-variant"></i></button>
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
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0" id="hospitalAppointments">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Vet Name</th>
                                        <th>Caretaker Name</th>
                                        <th>Caretaker ID</th>
                                        <th>Cat Name</th>
                                        <th>Cat ID</th>
                                        <th>Procedure</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($hosp)
                                        @php $i = 1; @endphp
                                        @foreach ($hosp as $app)
                                        <tr>

                                            <td>{{ $i }} </td>
                                            <td>{{ $app->name }} </td>
                                            <td>{{ $app->caretaker_name }} </td>
                                            <td>{{ $app->customer_id }} </td>
                                            <td>{{ $app->cat_name }} </td>
                                            <td>{{ $app->cat_id }} </td>
                                            <td>{{ $app->procedure_name }} </td>
                                            <td>{{ $app->date_appointment }} </td>
                                            <td>{{ $app->time_appointment }} </td>
                                        
                                            <td>
                                               
                                                <a href="#" class="px-3 text-primary" onclick="deleteAppointment({{$app->id}})"><i
                                                        class="uil uil-trash font-size-18"></i></a>
                                            </td>

                                        </tr>
                                        @php $i++; @endphp
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#hospitalAppointments').DataTable();

   
});
    function deleteAppointment(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this appointment?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function(result) {
            console.log(result);
            if (result.isConfirmed) {
                var data = []
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('appointment.delete')}}",
                    type: "POST",
                    data: { id:id },
                    success: function( response ) {
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