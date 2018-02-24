@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categories</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Edit Category
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! Form::open(['route' => ['categories.update', $category->slug], 'method' => 'PUT']) !!}
                                    {{ Form::inputTextField('title', 'Title', $category->title) }}
                                    {{ Form::inputTextField('description', 'Description', $category->description) }}
                                    {{ Form::checkboxField('published', 'Publish', true, $category->published) }}
                                    <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
                                    {{ Form::submit('Update Category', ['class' => 'btn btn-primary']) }}
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