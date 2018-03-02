<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                @foreach($categories->chunk(ceil($categories->count() / 2)) as $chunk)
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            @foreach($chunk as $category)
                                <li>
                                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->title }}</a>
                                    <span>&nbsp; ({{ $category->posts->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Tags</h5>
        <div class="card-body">
            @foreach($tags as $tag)
                <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->title }}</a>&nbsp;&nbsp;
            @endforeach
        </div>
    </div>

    <!-- Popular Posts Widget -->
    <div class="card my-4">
        <h5 class="card-header">Popular Posts</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($popularPosts as $post)
                    <li class="mb-2">
                        <a href="{{ route('post.show', [$post->category->slug, $post->slug]) }}">{{ $post->title }} </a>
                        <span><i class="fa fa-eye"></i> {{ $post->views }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Featured Posts Widget -->
    <div class="card my-4">
        <h5 class="card-header">Featured Posts</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($featuredPosts as $post)
                    <li class="mb-2">
                        <a href="{{ route('post.show', [$post->category->slug, $post->slug]) }}">{{ $post->title }} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Recent Posts Widget -->
    <div class="card my-4">
        <h5 class="card-header">Recent Posts</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($recentPosts as $post)
                    <li class="mb-2">
                        <a href="{{ route('post.show', [$post->category->slug, $post->slug]) }}">{{ $post->title }}</a>
                        <span class="text-muted">&nbsp; {{ $post->getPublishDate() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card my-4">
        <h5 class="card-header">Archives</h5>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($archives as $archive)
                    <li class="mb-2">
                        <a href="{{ url("/?month=$archive->month&year=$archive->year") }}">
                            {{ $archive->month }} {{ $archive->year }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>