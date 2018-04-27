{{ Form::model($unit, array('route' => array('units.update', $unit->id), 'method' => 'PUT')) }}

   <div class="form-group">
    {{ Form::label('type', 'Type') }}
    {{ Form::text('type', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
 <div class="form-group">
    {{ Form::label('code', 'Code') }}
    {{ Form::text('code', null, array('class' => 'form-control')) }}
</div>   
<div class="form-group">
    {{ Form::label('short_name', 'Short Name') }}
    {{ Form::text('short_name', null, array('class' => 'form-control')) }}
</div>   
 <div class="form-group">
    {{ Form::label('address', 'Address') }}
    {{ Form::text('address', null, array('class' => 'form-control')) }}
</div>   
<div class="form-group">
    {{ Form::label('active', 'Active', array('class' => 'col-md-12')) }}                    
    {{ Form::select('active', $active, null, array('class' => 'form-control', 'placeholder' => 'Pilih Active..')) }}                    
</div>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
