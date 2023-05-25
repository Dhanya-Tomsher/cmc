@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Caretaker Details'])
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="div">
                            <h4 class="mb-0">Caretaker Details</h4>
                        </div>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="#">Caretaker Details</a></li>
                            </ol>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('caretaker.index') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body py-4">
                            
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="avatar-upload caretaker_dp">
                                            <div class="avatar-preview">
                                                @if($caretaker[0]->image_url == NULL)
                                                    <div id="imagePreview" style="background-image: url('{{ asset('assets/images/user_img.png') }}');">
                                                    </div>
                                                @else
                                                    <div id="imagePreview" style="background-image: url('{{  asset($caretaker[0]->image_url) }}');">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="example-text-input" class="col-form-label">Customer ID</label>
                                        <input class="form-control" name="customer_id" readonly type="text" value="{{ $caretaker[0]->customer_id }}" id="example-text-input">
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="Name" class="col-form-label">Name</label>
                                        <input class="form-control" name="name" readonly type="text" placeholder="" id="Name" value="{{ $caretaker[0]->name }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea required="" name="address" readonly class="form-control" placeholder="" rows="2">{{ $caretaker[0]->address }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="col-form-label">Email ID</label>
                                        <input class="form-control" readonly name="email" type="email" placeholder="" id="Email" value="{{ $caretaker[0]->email }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input class="form-control" readonly name="phone_number" type="text" placeholder="" id="phone" value="{{ $caretaker[0]->phone_number }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="col-form-label">Whatsapp Number</label>
                                        <input class="form-control" readonly name="whatsapp_number" type="text"  placeholder="" id="whatsapp" value="{{ $caretaker[0]->whatsapp_number }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Home Country</label>
                                        <input type="text" class="form-control" value="{{ $caretaker[0]->care_country }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Emirate</label>
                                        <input type="text" class="form-control" value="{{ $caretaker[0]->emirate }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Place</label>
                                        <input class="form-control" readonly name="work_place" type="text" placeholder="" value="{{ $caretaker[0]->work_place }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Work Address</label>
                                        <input class="form-control" readonly name="work_address" type="text" placeholder="" value="{{ $caretaker[0]->work_address }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Position</label>
                                        <input class="form-control" readonly name="position" type="text" placeholder="" value="{{ $caretaker[0]->position }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="work-number" class="col-form-label">Work Contact Number</label>
                                        <input class="form-control" readonly name="work_contact_number" type="text"  placeholder="" id="work-number" value="{{ $caretaker[0]->work_contact_number }}">
                                    </div>

                                    <div class="col-md-4 passport_input align-items-center" id="myRadioGroup">
                                        <label for="emirates-id" class="col-form-label d-block">Passport No</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportYes" name="is_passport_no" disabled
                                                    class="form-check-input" value="show" {{ $caretaker[0]->is_passport_no == "1" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="PassportYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="PassportNo" name="is_passport_no" disabled
                                                    class="form-check-input" value="hide" {{ $caretaker[0]->is_passport_no == "0" ? 'checked' : '' }} >
                                                <label class="form-check-label" for="PassportNo">No</label>
                                            </div>
                                            <input class="form-control" name="passport_number" type="text"
                                                placeholder="" readonly style=" {{ $caretaker[0]->is_passport_no == "0" ? 'display:none;' : '' }}"
                                                value="{{ $caretaker[0]->passport_number }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4 passport_input align-items-center" id="input3">
                                        <label for="emirates-id" class="col-form-label d-block">Emirates ID</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="EmiratesYes" name="is_emirates_id" disabled
                                                    class="form-check-input" value="show" {{ $caretaker[0]->is_emirates_id == "1" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="EmiratesYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline"> 
                                                <input type="radio" id="EmiratesNo" name="is_emirates_id" disabled
                                                    class="form-check-input" value="hide" {{ $caretaker[0]->is_emirates_id == "0" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="EmiratesNo">No</label>
                                            </div>
                                            <input class="form-control" name="emirates_id_number" type="text"
                                                placeholder=""  readonly style=" {{ $caretaker[0]->is_emirates_id == "0" ? 'display:none;' : '' }}"
                                                value="{{ $caretaker[0]->emirates_id_number }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country" class="col-form-label">Visa Status</label>
                                        <input class="form-control" name="position" readonly type="text" placeholder="" value="{{ $caretaker[0]->visa_status }}">
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <label for="phone" class="col-form-label">Status</label>
                                        <input class="form-control" type="text" value="{{ ucfirst($caretaker[0]->status) }}" readonly id="microchip_number">
                                    </div> -->

                                    <div class="col-md-4">
                                        <label for="emirates-id" class="col-form-label d-block">BlackList Status</label>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-radio form-check form-check-inline">
                                                <input type="radio" id="blacklistYes" disabled {{ $caretaker[0]->is_blacklist == "1" ? 'checked' : '' }}  name="is_blacklist" class="form-check-input"  value="1">
                                                <label class="form-check-label" for="blacklistYes">Yes</label>
                                            </div>
                                            <div class="custom-radio form-check form-check-inline" >
                                                <input type="radio" id="blacklistNo" disabled name="is_blacklist" {{ $caretaker[0]->is_blacklist == "0" ? 'checked' : '' }} class="form-check-input" value="0" >
                                                <label class="form-check-label" for="blacklistNo">No</label>
                                            </div>

                                            <input class="form-control" type="text" readonly name="blacklist_reason" style="{{ $caretaker[0]->is_blacklist == "0" ? 'display:none;' : '' }}" value="{{ $caretaker[0]->blacklist_reason }}" placeholder="" id="blacklistReason" >
                                        
                                        </div>
                                    </div>
                                </div>

                            
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-lg-12">
                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3 class="mb-3">Cat Details</h3>
                                </div>
                            </div>
                        
                            <div class="table-responsive cat_details_table ">
                                <table class="table table-centered table-nowrap mb-0" id="catsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="w-5">No</th>
                                            <th>Cat Name</th>
                                            <th class="text-center w-10">Cat Image</th>
                                            <th class="text-center">Cat ID</th>
                                            <th class="text-center w-10">Gender</th>
                                            <th class="text-center w-10">Transfer Status</th>
                                            <th class="text-center w-15">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="catDetails">
                                        @foreach ($cats as $cat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td class="text-center">
                                                @if($cat->image_url == NULL)
                                                    <a href="{{ route('caretaker.cat.view', $cat) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset('assets/images/cat_plc.jpg') }} " data-holder-rendered="true"> </a>
                                                @else
                                                    <a href="{{ route('caretaker.cat.view', $cat) }}"><img class="rounded-circle avatar-md" alt="200x200" src="{{ asset($cat->image_url) }} " data-holder-rendered="true"> </a>
                                                @endif
                                                </td>
                                                <td class="text-center">{{ $cat->cat_id }}</td>
                                                <td class="text-center">{{ $cat->gender }}</td>
                                                <td  class="text-center">
                                                    @php  
                                                        $transfer_status = (Helper::getCatCaretakerLatestStatus($cat->id,$caretaker[0]->id) == 1) ? '<span class="badge bg-soft-danger font-size-12 text-uppercase">Transferred</span>' : '<span class="badge bg-soft-success font-size-12 text-uppercase">Owned</span>';
                                                    @endphp
                                                    {!! $transfer_status !!}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('caretaker.cat.view', $cat) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Profile" class="px-2 "><i class="uil uil-eye"></i></a>
                                                    
                                                    <a href="{{ route('cat.journal',['cat' => $cat->id, 'care_id' => $caretaker[0]->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Journal" class="px-2 "><i class="uil uil-history"></i></a>
                                                    
                                                    <a href="{{ route('hospital-appointments') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hospital" class="px-2 "><i class="uil uil-hospital"></i></a>
                                                    
                                                    <a href="{{ route('hotel-appointments') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hotel" class="px-2"><i class="uil uil-building"></i></a>
                                                    
                                                    <a href="{{ route('cat.edit', $cat) }}" data-bs-toggle="tooltip" data-bs-target=".bs-example-modal-lg" data-bs-placement="top" data-bs-title="Transfer Profile" class="px-2"><i class="uil uil-arrow-right"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- container-fluid -->
    </div>
@endsection
@push('header')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script>
// $('#catsTable').DataTable();  
$(document).ready(function() {
    oTable = $('#catsTable').dataTable();
    oTable.fnFilter( "^" + TERM + "$", COLUMN , true);
});
</script>
@endpush
