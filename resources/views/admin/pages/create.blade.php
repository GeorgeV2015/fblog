@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pages</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        New Page/Element
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! Form::open(['route' => 'pages.store']) !!}
                                    {{ Form::inputTextField('title', 'Title:', old('title')) }}
                                    @if($type === 'strElement' || $type === 'textElement')
                                        <input type="hidden" name="parent_id" value="{{ $page_id }}">
                                    @endif

                                    @if($type === 'strElement')
                                        {{ Form::inputTextField('content', 'Content:', old('content')) }}
                                    @endif

                                    @if($type === 'textElement')
                                        {{ Form::textareaField('content', 'Content:', old('content')) }}
                                    @endif

                                    <input type="hidden" name="type" value="{{ $type }}">

                                    {{ Form::checkboxField('published', 'Publish', true) }}

                                    <a href="{{ route('pages.index') }}" class="btn btn-default">Back</a>
                                    {{ Form::submit('Add Page', ['class' => 'btn btn-primary']) }}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

@endsection

@section('scripts')
    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script src="/plugins/ckfinder/ckfinder.js"></script>
    <script>
        $(document).ready(function () {
            var editor = CKEDITOR.replaceAll();
            CKFinder.setupCKEditor(editor);
        });
    </script>
@endsection