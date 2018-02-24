@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tags</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Tag List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <p>
                            <a href="{{ route('tags.create') }}" class="btn btn-primary">Add Tag</a>
                        </p>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Publish/Hide</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr class="odd gradeX">
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->title }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tags.edit', $tag->slug) }}" class="fa fa-pencil"></a>
                                    </td>
                                    <td class="text-center">
                                        @if($tag->published)
                                            <a href="{{ route('tags.toggle', $tag->slug) }}" class="fa fa-minus-circle" title="hide"></a>
                                        @else
                                            <a href="{{ route('tags.toggle', $tag->slug) }}" class="fa fa-thumbs-o-up" title="publish"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ Form::deleteButton('tags.destroy', $tag->slug) }}
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