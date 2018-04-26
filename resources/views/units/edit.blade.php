{{ Form::model($lookup, array('route' => array('lookups.update', $lookup->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        {{ Form::text('type', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('value', 'Value') }}
        {{ Form::text('value', null, array('class' => 'form-control')) }}
    </div>     
    <div class="form-group">
        {{ Form::label('order_no', 'Order Number') }}
        {{ Form::text('order_no', null, array('class' => 'form-control')) }}
    </div>  
<br>
{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
