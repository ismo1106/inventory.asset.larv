@extends('layouts.back')

@section('title', '| Edit Role')

@section('content')
<h1 class="page-title"><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>
<hr/>
<div class="row">
    <div class='col-md-6'>
        {{-- @include ('errors.list') --}}
        {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{ Form::label('name', 'Role Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <h5><b>Assign Permissions</b></h5>
        <div class="form-group">
            @foreach ($permissions as $permission)
            {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
            {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
            @endforeach
        </div>
        <div class="form-group">
            {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
        </div>
        {{ Form::close() }}    
    </div>
</div>
@endsection