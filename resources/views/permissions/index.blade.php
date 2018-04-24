@extends('layouts.app')

@section('title', '| Permissions')

@push('css')
<link href="assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet">
<link href="assets/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Add Permission</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'permissions')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div>
                <br>

                @if(!$roles->isEmpty())

                <h4>Assign Permission to Roles</h4>

                @foreach ($roles as $role) 
                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                @endforeach

                @endif

                <br>
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Permissions</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td> 
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="edit-pm btn btn-xs btn-info pull-left ladda-button" data-style="slide-left" style="margin-right: 3px;">
                                    <span class="ladda-label">Edit</span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                {!! Form::submit('Delete', ['class' => 'delete-pm btn btn-xs btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Account User -->
<div class="modal fade" id="modal-edit-permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Permission</h4>
            </div>
            <div id="modal-content-edit-permission" class="modal-body">
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
            $('#modal-content-edit-permission').html(response);
            $('#modal-edit-permission').modal('show');
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
            text: "Permission akan dihapus secara permanen!",
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