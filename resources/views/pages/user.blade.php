@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <h1 class="page-header my-4">User Profile</h1>
        @include('admin.includes.errors')

        <div class="card mb-4">
            <div class="card-body">
                <img class="img-fluid rounded m-auto d-block" src="{{ url('/' . $user->avatar) }}" alt="{{ $user->name }}" width="300">
                <ul class="nav nav-tabs mt-5">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#posts">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#comments">Comments</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">

                    <div class="tab-pane fade show active mt-4" id="personal">
                        <h4>Name: <em>{{ $user->name }}</em></h4>
                        <h4>Role: <em>{{ ($user->is_admin) ? 'Admin' : 'User' }}</em></h4>
                    </div>

                    <div class="tab-pane fade mt-4" id="posts">
                        @if($user->posts->count() > 0)
                        <ul class="list-group">
                            @foreach($user->posts as $post)
                                @if($post->published)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('post.show', [($post->category) ? $post->category->slug : 'no-category', $post->slug]) }}">{{ $post->title }}</a>
                                        <span><i class="fa fa-eye"></i>&nbsp; {{ $post->views }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        @else
                            <p class="lead">User has no posts yet</p>
                        @endif
                    </div>

                    <div class="tab-pane fade mt-4" id="comments">
                        @if($user->comments->count() > 0)
                            <ul class="list-group">
                                @foreach($user->comments as $comment)
                                    @if($comment->published && $comment->post->published)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('post.show', [($comment->post->category) ? $comment->post->category->slug : 'no-category', $comment->post->slug]) }}">{{ $comment->text }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="lead">User has no comments yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.sidebar')
@endsection