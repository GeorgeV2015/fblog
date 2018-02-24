@extends('admin.layout')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.includes.errors')
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        User List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <p>
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                        </p>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Ban / Activate</th>
                                <th class="text-center">Admin / Ordinary</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="odd gradeX">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img src="{{ url('/' . $user->avatar) }}" alt="{{ $user->name }}" class="image-responsive" width="100">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="fa fa-pencil"></a>
                                    </td>
                                    <td class="text-center">
                                        @if($user->banned_at)
                                            <a href="{{ route('users.toggle', $user->id) }}" class="fa fa-thumbs-o-up" title="activate"></a>
                                        @else
                                            <a href="{{ route('users.toggle', $user->id) }}" class="fa fa-gavel" title="ban"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($user->is_admin)
                                            <a href="{{ route('users.toggleRole', $user->id) }}" class="fa fa-cut" title="disgrace"></a>
                                        @else
                                            <a href="{{ route('users.toggleRole', $user->id) }}" class="fa fa-magic" title="set admin"></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ Form::deleteButton('users.destroy', $user->id) }}
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