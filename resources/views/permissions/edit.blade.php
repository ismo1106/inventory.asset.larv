{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

<div class="form-group">
    {{ Form::label('name', 'Permission Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<br>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
