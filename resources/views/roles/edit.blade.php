{{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
<div class="form-group">
    {{ Form::label('name', 'Role Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<h5><b>Assign Permissions</b></h5>
<div class="form-group">
    @foreach ($permissions as $permission)
    {{ Form::checkbox('permissions[]',  $permission->id, $role->permissions, array('id' => $permission->name)) }}
    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
    @endforeach
</div>
<div class="form-group">
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
</div>
{{ Form::close() }} 