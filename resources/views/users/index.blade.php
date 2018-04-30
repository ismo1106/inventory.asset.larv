@extends('layouts.app')

@section('title', '| Users')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a id="add-user" href="{{ route('users.create') }}" class="btn btn-xs btn-success ladda-button" data-style="slide-left"><span class="ladda-label">Add User</span></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">User</h4>
            </div>
            <div class="panel-body">
                <table id="tbl-users" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Modified</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add User -->
<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div id="modal-content-add-user" class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div id="modal-content-edit-user" class="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ladda/ladda.min.js') }}"></script>
@endpush
@push('script')
<script>
jQuery(document).ready(function () {
    var table = $('#tbl-users').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ url()->current() }}"
        },
        columns: [
            {data: 'updated_at', name: 'updated_at'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'role', name: 'role'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'nowrap flex'}
        ]
    }).on('draw', function () {
        
    });

    $('#add-user').click(function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        var ini = $(this);
        l.start();
        $(this).addClass('disabled');

        var url = $(this).attr('href');
        $.get(url, function (response) {
            l.stop();
            ini.removeClass('disabled');
            $('#modal-content-add-user').html(response);
            $('#modal-add-user').modal('show');
        }).fail(function () {
            l.stop();
            ini.removeClass('disabled');
            swal('Oh snap..', 'Has been error on system', 'error');
        });
    });
    
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