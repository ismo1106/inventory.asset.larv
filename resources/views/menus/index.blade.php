@extends('layouts.app')

@section('title', '|Menus')

@push('css')
<link href="assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet">
<link href="assets/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
<link href="{{ asset('css/nestable.css') }}" rel="stylesheet">
@endpush

@push('style')
<style>
    .dd-handle{
        width: 90%;
    }
    .action-me{
        margin-top: -32px
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Add Menu</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'menus')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('url', 'URL') }}
                    {{ Form::text('url', null, array('class' => 'form-control')) }}
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
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        @foreach($menus['level_1'] as $mn1)
                        <li class="dd-item" data-id="{{ $mn1->id }}">
                            <div class="dd-handle">{{ $mn1->name }}</div>
                            <span class="pull-right action-me">
                                <a href="{{ route('menus.edit', $mn1->id) }}" class="mn-edit btn btn-xs btn-icon btn-circle btn-success ladda-button" data-style="slide-left">
                                    <span class="ladda-label"><i class="fa fa-pencil"></i></span></a>
                                <a href="{{ route('menus.destroy', $mn1->id) }}" class="mn-delete btn btn-xs btn-icon btn-circle btn-danger" data-del="form-delmenu-{{$mn1->id}}"><i class="fa fa-trash-o"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['menus.destroy', $mn1->id], 'class' => 'form-delmenu-' . $mn1->id]) !!}
                                {!! Form::close() !!}
                            </span>
                            @if(\App\Helpers\MenuCheck::__haveChild($mn1->id))
                            <ol class="dd-list">
                                @endif
                                @foreach($menus['level_2'] as $mn2)
                                @if($mn2->header == $mn1->id)
                                <li class="dd-item" data-id="{{ $mn2->id }}">
                                    <div class="dd-handle">{{ $mn2->name }}</div>
                                    <span class="pull-right action-me">
                                        <a href="{{ route('menus.edit', $mn2->id) }}" class="mn-edit btn btn-xs btn-icon btn-circle btn-success ladda-button" data-style="slide-left">
                                            <span class="ladda-label"><i class="fa fa-pencil"></i></span></a>
                                        <a href="{{ route('menus.destroy', $mn2->id) }}" class="mn-delete btn btn-xs btn-icon btn-circle btn-danger" data-del="form-delmenu-{{$mn2->id}}"><i class="fa fa-trash-o"></i></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['menus.destroy', $mn2->id], 'class' => 'form-delmenu-' . $mn2->id]) !!}
                                        {!! Form::close() !!}
                                    </span>
                                </li>
                                @endif
                                @endforeach
                                @if(\App\Helpers\MenuCheck::__haveChild($mn1->id))
                            </ol>
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </div>

                <div class="clearfix"></div>

                {{ Form::open(array('route' => 'menus.update.sort')) }}
                <textarea name="txt-sort" id="nestable-output" class="hide"></textarea>
                <div class="form-group m-t-20">
                    {{ Form::submit('Sort & Update', array('class' => 'btn btn-primary btn-sm btn-block')) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Menu -->
<div class="modal fade" id="modal-edit-menu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Menu</h4>
            </div>
            <div id="modal-content-edit-menu" class="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/ladda/spin.min.js"></script>
<script src="assets/plugins/ladda/ladda.min.js"></script>
<script src="{{ asset('js/jquery.nestable.js') }}"></script>
@endpush
@push('script')
<script>
jQuery(document).ready(function () {
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1,
        maxDepth: 2
    }).on('change', updateOutput);

    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('.mn-edit').click(function (e) {
        e.preventDefault();
        var l = Ladda.create(this);
        var ini = $(this);
        l.start();
        $(this).addClass('disabled');

        var url = $(this).attr('href');
        $.get(url, function (response) {
            l.stop();
            ini.removeClass('disabled');
            $('#modal-content-edit-menu').html(response);
            $('#modal-edit-menu').modal('show');
        }).fail(function () {
            l.stop();
            ini.removeClass('disabled');
            swal('Oh snap..', 'Has been error on system', 'error');
        });
    });

    $('.mn-delete').click(function (e) {
        e.preventDefault();
        var fmDel = $(this).data('del');
        swal({
            title: "Are you sure?",
            text: "Menu akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            $('.' + fmDel).submit();
        });
    });
});
</script>
@endpush