@extends('layouts.app')

@section('content')
    <div class="col-md-8">

        <!-- Title -->
        <h1 class="mt-4">{{ $title or $page->title }}</h1>

        @include('admin.includes.errors')

        {!! $content or '' !!}

    </div>

    @include('partials.sidebar')
@endsection