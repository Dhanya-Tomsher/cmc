@extends('admin.layouts.app', ['body_class' => '', 'title' => 'Hotel Rooms'])
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="div">
                        <h4 class="mb-0">Edit Form Details</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('forms.index') }}">Forms</a>
                            </li>

                        </ol>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('forms.index') }}" class="btn btn_back waves-effect waves-light"> <i class="uil-angle-left-b"></i> Back</a>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 border">
                                <div class="col-md-12 text-center">
                                    <h3>{{$form->form_title}}</h3>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    {!! $form->form_content !!}
                                </div>
                            </div>
                        </div>
                        
                        
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
.border{
    border: 1px solid #ececec !important;
    padding : 2% 2% 2% !important;
}
</style>
@endpush

@push('scripts')

<script type="text/javascript">

</script>
@endpush