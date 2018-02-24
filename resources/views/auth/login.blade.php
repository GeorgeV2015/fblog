@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <h1 class="page-header my-4">Login</h1>
        @include('admin.includes.errors')

        <div class="card mb-4">
            <div class="card-body">
                {!! Form::open(['route' => 'login']) !!}
                    {{ Form::inputTextField('email', 'Email:', old('email')) }}
                    {{ Form::inputPassField('password', 'Password:') }}
                    {{ Form::checkboxField('remember', 'Remember me', null, null, ['class' => 'ml-4']) }}
                    {{ Form::submit('Sign in', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('partials.sidebar')
@endsection
