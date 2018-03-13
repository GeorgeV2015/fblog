@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Posts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Edit Post
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! Form::open(['route' => ['posts.update', $post->slug], 'method' => 'PUT', 'files' => true]) !!}
                                    {{ Form::inputTextField('title', 'Title:', $post->title) }}
                                    {{--<div class="form-group">
                                        <img src="{{ url($post->image['normal']) }}" alt="{{ $post->title }}" class="image-responsive" width="300">
                                    </div>--}}
                                    <div class="form-group" id="image-preview">
                                        <label for="image-upload" id="image-label">Choose file</label>
                                        <input type="file" name="image" id="image-upload" data-image="{{ $post->image['normal'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Current category: </label> {{ ($post->category) ? $post->category->title : 'No category' }}
                                    </div>
                                    {{ Form::selectField('category_id', 'Category:', $categories, ($post->category) ? $post->category->id : null) }}
                                    {{ Form::selectField(
                                        'tags[]',
                                        'Tags:',
                                        $tags,
                                        $selectedTags,
                                        ['multiple' => 'multiple', 'data-placeholder' => 'Choose Tags']) }}
                                    <div class="form-group">
                                        <label for="datepicker">Publish date:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" name="publishDate" value="{{ $post->publishDate }}">
                                        </div>
                                    </div>
                                    {{ Form::checkboxField('published', 'Publish', true, $post->published) }}
                                    {{ Form::checkboxField('is_featured', 'Featured', true, $post->is_featured) }}
                                    {{ Form::textareaField('content', 'Content:', $post->content) }}
                                    {{ Form::textareaField('description', 'Description:', $post->description) }}
                                    <a href="{{ route('posts.index') }}" class="btn btn-default">Back</a>
                                    {{ Form::submit('Update Post', ['class' => 'btn btn-primary']) }}
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