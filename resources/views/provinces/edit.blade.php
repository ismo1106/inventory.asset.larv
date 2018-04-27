{{ Form::model($province, array('route' => array('provinces.update', $province->id), 'method' => 'PUT')) }}  
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('value', 'Value') }}
        {{ Form::text('value', null, array('class' => 'form-control')) }}
    </div>     
<br>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
