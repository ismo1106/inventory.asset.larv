{{ Form::model($urbanvillage, array('route' => array('urbanvillages.update', $urbanvillage->id), 'method' => 'PUT')) }}
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
        {{ Form::select('province_id', $province, null, array('class' => 'form-control', 'placeholder' => 'Pilih Provinsi..')) }}                    
    </div>
    <div class="form-group">
        {{ Form::label('city_id', 'City', array('class' => 'col-md-12')) }}                    
        {{ Form::select('city_id', $city, null, array('class' => 'form-control', 'placeholder' => 'Pilih City..')) }}                    
    </div>
    <div class="form-group">
        {{ Form::label('sub_districts_id', 'Sub District', array('class' => 'col-md-12')) }}                    
        {{ Form::select('sub_districts_id', $sub_district, null, array('class' => 'form-control', 'placeholder' => 'Pilih Sub District..')) }}                    
    </div> 
<br>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
