@extends('layouts.back')

@section('title', '| Roles')

@section('content')
<h1 class="page-title">
    <i class="fa fa-key"></i> Roles
    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm pull-right">Add Role</a>
    <a href="{{ route('users.index') }}" class="btn btn-default btn-sm pull-right">Users</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm pull-right">Permissions</a>
</h1>
<hr/>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{  $role->permissions()->pluck('name')->implode(', ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection