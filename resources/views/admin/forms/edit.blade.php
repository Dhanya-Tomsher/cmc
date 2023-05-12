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
                        @if(session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <form name="frm" action="{{ route('form.store') }}" enctype="multipart/form-data"  method="POST">

                            @csrf
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <label for="Name" class="col-form-label"><b>Title</b> <span class="required">*</span></label>
                                    <input type="hidden" id="form_id" name="form_id" value="{{$form->id}}">
                                    <input class="form-control" name="title" value="{{ old('title',$form->form_title) }}" type="text" placeholder="Enter form title" id="title">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="address" class="col-form-label"><b>Content</b> <span class="required">*</span></label>
                                   <textarea class="form-control content" name="content" value="{{ old('content',$form->form_content) }}" placeholder="Enter form content" id="content"> </textarea>
                                    @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8 offset-md-2 mt-4">
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
<style>
.ck-editor__editable_inline {
    height: 500px;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>

<script type="text/javascript">
    const editor =  ClassicEditor .create( document.querySelector( '#content' ), {
        width:['250px'],
        removePlugins: ["EasyImage","ImageUpload","MediaEmbed"]
    } )
    .then( editor => {
        editor.setData(`{!! $form->form_content !!}`);
    } )
    .catch( error => {
        console.log( error );
    } );

</script>
@endpush