@extends('layouts.app')

@section('title', '| Lookup')

@push('css')
<link href="assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet">
<link href="assets/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">   
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Unit</h4>
            </div>
            {!! Form::open(['method' => 'GET', 'url' => '/units', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Short Name</th>
                            <th>Address</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->type }}</td> 
                            <td>{{ $unit->name }}</td> 
                            <td>{{ $unit->code }}</td>                             
                            <td>{{ $unit->short_name }}</td> 
                            <td>{{ $unit->address }}</td> 
                            <td>{{ $unit->active }}</td> 
                            <td>
                                <a href="{{ route('units.edit', $unit->id) }}" class="edit-pm btn btn-xs btn-info pull-left ladda-button" data-style="slide-left" style="margin-right: 3px;">
                                    <span class="ladda-label">Edit</span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['units.destroy', $unit->id] ]) !!}
                                {!! Form::submit('Delete', ['class' => 'delete-pm btn btn-xs btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper pull-right"> {!! $units->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
    
     <div class="col-md-6 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Add Unit</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'units')) }}

                <div class="form-group">
                    {{ Form::label('type', 'Type') }}
                    {{ Form::text('type', '', array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div>
                 <div class="form-group">
                    {{ Form::label('code', 'Code') }}
                    {{ Form::text('code', '', array('class' => 'form-control')) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('short_name', 'Short Name') }}
                    {{ Form::text('short_name', '', array('class' => 'form-control')) }}
                </div>   
                 <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', '', array('class' => 'form-control')) }}
                </div>                 
                <div class="form-group">
                    {{ Form::label('active', 'Active', array('class' => 'col-md-12')) }}                    
                    {{ Form::select('active', $active, null, array('class' => 'form-control', 'placeholder' => 'Pilih Active..')) }}                    
                </div>
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>

<!-- Modal Edit Account User -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Lookup</h4>
            </div>
            <div id="modal-content-edit" class="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/ladda/spin.min.js"></script>
<script src="assets/plugins/ladda/ladda.min.js"></script>
@endpush
@push('script')
<script>
jQuery(document).ready(function () {
    $('.edit-pm').click(function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        var ini = $(this);
        l.start();
        $(this).addClass('disabled');
        var url = $(this).attr('href');
        $.get(url, function (response) {            
            l.stop();
            ini.removeClass('disabled');
            $('#modal-content-edit').html(response);
            $('#modal-edit').modal('show');
        }).fail(function () {
            l.stop();
            ini.removeClass('disabled');
            swal('Oh snap..', 'Has been error on system', 'error');
        });
    });

    $('.delete-pm').click(function (e) {
        e.preventDefault();
        var ini = $(this).parent('form');
        swal({
            title: "Are you sure?",
            text: "Lookup akan dihapus secara permanen!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            ini.submit();
        });
    });
});
</script>
@endpush