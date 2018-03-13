@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <h1 class="page-header my-4">User Profile</h1>
        @include('admin.includes.errors')

        <div class="card mb-4">
            <div class="card-body">
                {{--<img class="img-fluid rounded m-auto d-block" src="{{ url($user->avatar) }}" alt="{{ $user->name }}" width="300">--}}
                {!! Form::open(['route' => 'profile', 'files' => true]) !!}
                    <div class="form-group m-auto" id="image-preview">
                        <label for="image-upload" id="image-label">Choose file</label>
                        <input type="file" name="avatar" id="image-upload" data-image="{{ $user->avatar }}">
                    </div>
                    {{ Form::inputTextField('name', 'Name:', $user->name) }}
                    {{ Form::inputTextField('email', 'Email:', $user->email) }}
                    {{ Form::inputPassField('password', 'Password:') }}
                    {{ Form::submit('Update profile', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection