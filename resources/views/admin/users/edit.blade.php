@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Edit User
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                                    {{ Form::inputTextField('name', 'Name:', $user->name) }}
                                    {{ Form::inputTextField('email', 'Email:', $user->email) }}
                                    {{ Form::inputPassField('password', 'Password:') }}
                                    {{--<div class="form-group">
                                        <img src="{{ url('/' . $user->avatar) }}" alt="{{ $user->name }}" class="image-responsive" width="300">
                                    </div>--}}
                                    <div class="form-group" id="image-preview">
                                        <label for="image-upload" id="image-label">Choose file</label>
                                        <input type="file" name="avatar" id="image-upload" data-image="{{ '/' . $user->avatar }}">
                                    </div>
                                    {{ Form::checkboxField('is_admin', 'Admin', true, $user->is_admin) }}
                                    <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                                    {{ Form::submit('Update User', ['class' => 'btn btn-primary']) }}
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