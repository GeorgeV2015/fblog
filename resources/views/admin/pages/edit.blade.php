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
                        Edit Page/Element
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! Form::open(['route' => ['pages.update', $page->slug], 'method' => 'PUT']) !!}
                                    {{ Form::inputTextField('title', 'Title:', $page->title) }}
                                    @if($page->type === 'strElement' || $page->type === 'textElement')
                                        {{ Form::selectField('parent_id', 'Parent Page:', $pages, $page->parent_id) }}
                                        {{ Form::selectField('type', 'Type:', ['strElement' => 'strElement', 'textElement' => 'textElement'], $page->type) }}
                                        @if($page->type === 'strElement')
                                        {{ Form::inputTextField('content', 'Content:', $page->content) }}
                                        @endif
                                        @if($page->type === 'textElement')
                                            {{ Form::textareaField('content', 'Content:', $page->content) }}
                                        @endif
                                    @endif

                                    {{ Form::checkboxField('published', 'Publish', true, $page->published) }}

                                    <a href="{{ route('pages.index') }}" class="btn btn-default">Back</a>
                                    {{ Form::submit('Update Page', ['class' => 'btn btn-primary']) }}
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