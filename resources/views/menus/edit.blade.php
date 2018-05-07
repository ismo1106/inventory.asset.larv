{{ Form::model($menu, array('route' => array('menus.update', $menu->id), 'method' => 'PUT')) }}
{{ Form::open(array('url' => 'menus')) }}
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('url', 'URL') }}
    {{ Form::text('url', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('icon', 'Icon') }}
    <select name="icon" class="form-control select-fa">
        <option>Choose...</option>
        @foreach(\App\Helpers\MenuCheck::__optFA() as $faKey => $fa)
        <option value="{{$faKey}}">&#x{!!$fa!!} {{$faKey}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
</div>
{{ Form::close() }} 