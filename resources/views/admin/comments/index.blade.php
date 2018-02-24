@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comments</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Comments List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Text</th>
                                <th class="text-center">Post</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Allow</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr class="odd gradeX">
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->text }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', $comment->post->slug) }}">{{ $comment->post->title }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        @if($comment->published)
                                            <a href="{{ url('/admin/comments/toggle/' . $comment->id) }}" class="fa fa-minus-circle" title="ban"></a>
                                        @else
                                            <a href="{{ url('/admin/comments/toggle/' . $comment->id) }}" class="fa fa-thumbs-o-up" title="allow"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ Form::deleteButton('comments.destroy', $comment->id) }}
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