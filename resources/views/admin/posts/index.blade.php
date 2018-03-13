@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Posts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Posts List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                        </p>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Tags</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Publish / Hide</th>
                                <th class="text-center">Featured / Normal</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr class="odd gradeX">
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ ($post->category) ? $post->category->title : 'No category' }}</td>
                                    <td>{{ implode(', ', $post->tags->pluck('title')->all()) }}</td>
                                    <td>
                                        <img src="{{ url($post->image['min']) }}" alt="{{ $post->title }}" class="image-responsive" width="150">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="fa fa-pencil"></a>
                                    </td>
                                    <td class="text-center">
                                        @if($post->published)
                                            <a href="{{ route('posts.toggle', $post->slug) }}" class="fa fa-minus-circle" title="hide"></a>
                                        @else
                                            <a href="{{ route('posts.toggle', $post->slug) }}" class="fa fa-thumbs-o-up" title="publish"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($post->is_featured)
                                            <a href="{{ route('posts.toggleFeatured', $post->slug) }}" class="fa fa-undo" title="set normal"></a>
                                        @else
                                            <a href="{{ route('posts.toggleFeatured', $post->slug) }}" class="fa fa-flag" title="set featured"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ Form::deleteButton('posts.destroy', $post->slug) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection