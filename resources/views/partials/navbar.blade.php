<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">FBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-5">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="Category-dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
                    <div class="dropdown-menu" aria-labelledby="Category-dropdown">
                        @foreach($categories as $category)
                            <a class="dropdown-item" href="{{ route('category.show', $category->slug) }}">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </li>

                @if($pages->count() > 0)
                    @foreach($pages as $page)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url($page->title) }}">{{ ucfirst($page->title) }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="navbar-nav ml-auto mr-4">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="profile-dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} </a>
                        <div class="dropdown-menu" aria-labelledby="profile-dropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                            @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin') }}">Admin dashboard</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>