@extends('layouts.app')

@section('title', '| Roles')

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
                <h4 class="panel-title">Add Role</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'roles')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <h5><b>Assign Permissions</b></h5>
                <div class='form-group'>
                    @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

                    @endforeach
                </div>
                <div class='form-group'>
                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                </div>
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
                <h4 class="panel-title">Roles</h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{  $role->permissions()->pluck('name')->implode(', ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="edit-rl btn btn-info btn-sm pull-left ladda-button" data-style="slide-left" style="margin-right: 3px;">
                                <span class="ladda-label">Edit</span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'delete-rl btn btn-danger btn-sm']) !!}
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
<div class="modal fade" id="modal-edit-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Role</h4>
            </div>
            <div id="modal-content-edit-role" class="modal-body">
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
    $('.edit-rl').click(function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        var ini = $(this);
        l.start();
        $(this).addClass('disabled');

        var url = $(this).attr('href');
        $.get(url, function (response) {
            l.stop();
            ini.removeClass('disabled');
            $('#modal-content-edit-role').html(response);
            $('#modal-edit-role').modal('show');
        }).fail(function () {
            l.stop();
            ini.removeClass('disabled');
            swal('Oh snap..', 'Has been error on system', 'error');
        });
    });

    $('.delete-rl').click(function (e) {
        e.preventDefault();
        var ini = $(this).parent('form');
        swal({
            title: "Are you sure?",
            text: "Role akan dihapus secara permanen!",
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