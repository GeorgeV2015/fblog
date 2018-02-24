@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <h1 class="page-header my-4">Register</h1>
        @include('admin.includes.errors')

        <div class="card mb-4">
            <div class="card-body">
                {!! Form::open(['route' => 'register']) !!}
                    {{ Form::inputTextField('name', 'Name:', old('name')) }}
                    {{ Form::inputTextField('email', 'Email:', old('email')) }}
                    {{ Form::inputPassField('password', 'Password:') }}
                    {{ Form::inputPassField('password_confirmation', 'Confirm Password:') }}
                    {{ Form::submit('Register', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('partials.sidebar')

@endsection
