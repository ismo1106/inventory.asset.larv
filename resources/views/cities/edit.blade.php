{{ Form::model($city, array('route' => array('cities.update', $city->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('value', 'Value') }}
        {{ Form::text('value', null, array('class' => 'form-control')) }}
    </div>     
    <div class="form-group">
        {{ Form::label('province_id', 'Province', array('class' => 'col-md-12')) }}                    
        {{ Form::select('province_id', $province, $city->province_id, array('class' => 'form-control', 'placeholder' => 'Pilih Bank..')) }}                    
    </div>
<br>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
