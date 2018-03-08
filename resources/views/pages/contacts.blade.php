@extends('layouts.app')

@section('content')
    <div class="col-md-12 mb-5">
        <!-- Title -->
        <h1 class="mt-4">{{ $title or '' }}</h1>

        <div class="row">
            <div class="col-md-8">
                <p>{!! $promoteText or '' !!}</p>
                @include('admin.includes.errors')
                {{ Form::open(['route' => 'mail']) }}
                    {{ Form::inputTextField('name', 'Name:', old('name')) }}
                    <div class="row">
                        <div class="col-md-5">
                            {{ Form::inputTextField('phone', 'Phone:', old('phone'), ['placeholder' => '(xxx)-xxx-xx-xx']) }}
                        </div>
                        <div class="col-md-7">
                            {{ Form::inputTextField('email', 'Email:', old('email')) }}
                        </div>
                    </div>
                    {{ Form::textareaField('message', 'Message:', old('message')) }}
                    <div class="g-recaptcha pull-right card" data-sitekey="6LfkD0cUAAAAAJ0ew4YjMxMj0V2oXNVZKz3D-TVo"></div>
                    {{ Form::submit('Send', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
            <div class="col-md-4 mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-map-marker"></i>&nbsp; {{ $address or '' }}</li>
                    <li class="list-group-item"><i class="fa fa-phone"></i>&nbsp; {{ $phone or '' }}</li>
                    <li class="list-group-item"><i class="fa fa-envelope-o"></i>&nbsp; {{ $email or '' }}</li>
                    <li class="list-group-item"><i class="fa fa-github"></i>&nbsp; <a href="{{ $github or '#' }}">github</a></li>
                </ul>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
@endsection