<div class="row">
    <div class="col-md-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable" style="margin-top: 25px">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissable" style="margin-top: 25px">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! session('success_message') !!}
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissable" style="margin-top: 25px">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! session('error_message') !!}
        </div>
        @endif
    </div>
</div>