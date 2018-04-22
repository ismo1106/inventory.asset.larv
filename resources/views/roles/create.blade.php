@extends('layouts.app')

@section('title', '| Add Role')

@section('content')
<!-- begin page-header -->
<h1 class="page-header">Role <small>Create New Role</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <div class="col-md-6 col-sm-6">
        {{-- @include ('errors.list') --}}
        {{ Form::open(array('url' => 'roles')) }}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <h5><b>Assign Permissions</b></h5>
        <div class='form-group'>
            @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

            @endforeach
        </div>
        <div class='form-group'>
            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
<!-- end row -->
@endsection