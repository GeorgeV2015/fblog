<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">FBlog Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}&nbsp; <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                {{--<li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    <!-- /input-group -->
                </li>--}}
                <li>
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Homepage</a>
                </li>
                <li>
                    <a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('posts.index') }}"><i class="fa fa-th-list"></i> Posts</a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"><i class="fa fa-list-alt"></i> Categories</a>
                </li>
                <li>
                    <a href="{{ route('tags.index') }}"><i class="fa fa-tags"></i> Tags</a>
                </li>
                <li>
                    <a href="{{ url('/admin/comments') }}">
                        <i class="fa fa-comments-o"></i>
                        Comments
                        <span class="pull-right">
                            <small class="badge bg-info">{{ $unpublishedComments }}</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users</a>
                </li>
                <li>
                    <a href="{{ route('pages.index') }}"><i class="fa fa-files-o"></i> Pages</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>