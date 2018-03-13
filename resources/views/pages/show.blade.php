@extends('layouts.app')

@section('content')
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        @include('admin.includes.errors')

        <!-- Author -->
        <p class="lead">
            by
            @if($post->author !== null)
                <a href="{{ route('user', $post->author->id) }}">{{ $post->author->name }}</a>
            @else
                <span class="text-muted">Anonim</span>
            @endif
            <span class="float-right">Category:
                <a href="{{ route('category.show', $post->category->slug) }}" class="btn btn-link">{{ $post->category->title }}</a>
            </span>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{ $post->getPublishDate() }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ url($post->image['normal']) }}" alt="{{ $post->title }}">

        <hr>

        <!-- Post Content -->
        <div>
            {!! $post->content !!}
        </div>

        @foreach($post->tags as $tag)
            @if($tag->published)
                <a href="{{ route('tag.show', $tag->slug) }}" class="btn btn-outline-primary">{{ $tag->title }}</a>
            @endif
        @endforeach

        <hr>

        <ul class="pagination justify-content-center mb-4">
            @if($postNavigation['previous'])
                <li class="page-item">
                    <a class="page-link" href="{{ route('post.show', [$postNavigation['previous']->category->slug, $postNavigation['previous']->slug]) }}">&larr; Previous Post</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">&larr; Previous Post</a>
                </li>
            @endif
            @if($postNavigation['next'])
                <li class="page-item">
                    <a class="page-link" href="{{ route('post.show', [$postNavigation['next']->category->slug, $postNavigation['next']->slug]) }}">Next Post &rarr;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next Post &rarr;</a>
                </li>
            @endif
        </ul>

        <hr>

        <!-- Comments Form -->
        @if(Auth::check())
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    {!! Form::open(['route' => 'comment']) !!}
                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                        {{ Form::textareaField('text', ' ', old('text'), ['rows' => 3, 'placeholder' => 'Write your comment...']) }}
                        {{ Form::submit('Add Comment', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        @endif

        <h3 class="mb-4">Comments: ({{ $comments->count() }})</h3>
        @foreach($comments as $comment)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="{{ ($comment->user !== null) ? url($comment->user->avatar) : '/img/no-avatar.png' }}" alt="{{ ($comment->user !== null) ? $comment->user->name : 'anonim' }}" width="60">
                <div class="media-body">
                    <a href="{{ route('user', $comment->user->id) }}">
                        <h5 class="mt-0">{{ ($comment->user !== null) ? $comment->user->name : 'anonim' }}
                            <small class="text-muted float-right"><i class="fa fa-clock-o"></i>&nbsp; {{ $comment->created_at->diffForHumans() }}</small>
                        </h5>
                    </a>
                    {{ $comment->text }}
                </div>
            </div>
        @endforeach

    </div>
    <!-- Sidebar Widgets Column -->
    @include('partials.sidebar')

@endsection
