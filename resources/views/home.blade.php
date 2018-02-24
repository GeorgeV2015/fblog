@extends('layouts.app')

@section('content')
    <div class="col-md-8">

        <h1 class="my-4">{{ $title }}</h1>

        @if($posts->count() === 0)
            <p class="lead">There are no posts in selected section</p>
        @endif
        <!-- Blog Post -->
        @foreach($posts as $post)
            @if(isset($post->category) && $post->category->published)
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ url('/' . $post->image['normal']) }}" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <div class="text-center">
                            <a class="btn btn-link btn-lg" href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->title }}</a>
                        </div>
                        <p class="card-text">{!! $post->description !!}</p>
                        <a href="{{ route('post.show', [($post->category) ? $post->category->slug : 'no-category', $post->slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ $post->getPublishDate() }} by
                        @if($post->author !== null)
                            <a href="{{ route('user', $post->author->id) }}">
                                {{ $post->author->name }}
                            </a>
                        @else
                            <span>Anonim</span>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        {{ $posts->links() }}

    </div>

    <!-- Sidebar Widgets Column -->
    @include('partials.sidebar')

@endsection
