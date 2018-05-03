{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', null, array('class' => 'form-control')) }}
</div>

<div class='form-group'>
    @foreach ($roles as $role)
    <div class="checkbox">
        <label>
            {{ Form::checkbox('roles[]',  $role->id ) }} {{ ucfirst($role->name) }}
        </label>
    </div>
    @endforeach
</div>

<div class="form-group">
    {{ Form::label('status', 'Status') }}
    <div>
        <label class="radio-inline">
            {{ Form::radio('status', 1) }} Active
        </label>
        <label class="radio-inline">
            {{ Form::radio('status', 0) }} Not Active
        </label>
    </div>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}