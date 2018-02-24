<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FBlog</title>

    <link href="/css/front.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
@include('partials.navbar')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
    @yield('content')

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
@include('partials.footer')

<script src="/js/front.js"></script>

@yield('scripts')

</body>

</html>
