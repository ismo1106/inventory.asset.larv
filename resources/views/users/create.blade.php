{{ Form::open(array('route' => array('users.store'))) }}
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

<div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('password_confirmation', 'Password Confirmation') }}
    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
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
            {{ Form::radio('status', 1, true) }} Active
        </label>
        <label class="radio-inline">
            {{ Form::radio('status', 0) }} Not Active
        </label>
    </div>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}