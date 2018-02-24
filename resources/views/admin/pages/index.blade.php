@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pages</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Pages List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <p>
                            <a href="{{ route('pages.create', ['type' => 'page']) }}" class="btn btn-primary">Add Page</a>
                        </p>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Parent Page</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Add String Element</th>
                                <th class="text-center">Add Text Element</th>
                                <th class="text-center">Publish/Hide</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">Preview</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr class="odd gradeX">
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>
                                        @if($page->type === 'strElement' || $page->type === 'textElement')
                                            {{ $page->getParent()->title }}
                                        @endif
                                    </td>
                                    <td>{{ $page->type }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pages.edit', $page->slug) }}" class="fa fa-pencil"></a>
                                    </td>

                                    <td class="text-center">
                                        @if($page->type === 'page')
                                            <a href="{{ route('pages.create', ['type' => 'strElement', 'page_id' => $page->id]) }}" class="fa fa-plus"></a>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($page->type === 'page')
                                            <a href="{{ route('pages.create', ['type' => 'textElement', 'page_id' => $page->id]) }}" class="fa fa-plus"></a>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($page->published)
                                            <a href="{{ route('pages.toggle', $page->slug) }}" class="fa fa-minus-circle" title="hide"></a>
                                        @else
                                            <a href="{{ route('pages.toggle', $page->slug) }}" class="fa fa-thumbs-o-up" title="publish"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ Form::deleteButton('pages.destroy', $page->slug) }}
                                    </td>
                                    <td class="text-center">
                                        @if($page->type === 'page')
                                            <a href="{{ url($page->title) }}" class="fa fa-eye" target="_blank"></a>
                                        @endif
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