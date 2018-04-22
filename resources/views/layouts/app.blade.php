<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>FAST | @yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/style-responsive.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL STYLE ================== -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
        <!-- ================== END BASE JS ================== -->

        @stack('style')
    </head>
    <body>
        <!-- begin #page-loader -->
        <!--<div id="page-loader" class="fade in"><span class="spinner"></span></div>-->
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="page-sidebar-fixed page-header-fixed">
            @include('layouts/elements/header')
            @include('layouts/elements/sidebar')       

            <!-- begin #content -->
            <div id="content" class="content">
                <div class="row">
                    <div class="col-md-12">
                        @include ('errors.list')
                    </div>
                </div>

                @if(Session::has('success_message'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('success_message') !!}
                        </div>
                    </div>
                </div>
                @endif
                @if(Session::has('error_message'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('error_message') !!}
                        </div>
                    </div>
                </div>
                @endif
                
                @yield('content')
            </div>
            <!-- end #content -->

            <!-- begin scroll to top btn -->
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
            <!-- end scroll to top btn -->
        </div>
        <!-- end page container -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="{{ asset('assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!--[if lt IE 9]>
                <script src="{{ asset('assets/crossbrowserjs/html5shiv.js') }}"></script>
                <script src="{{ asset('assets/crossbrowserjs/respond.min.js') }}"></script>
                <script src="{{ asset('assets/crossbrowserjs/excanvas.min.js') }}"></script>
        <![endif]-->
        <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
        <!-- ================== END BASE JS ================== -->

        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.pie.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard.min.js') }}"></script>
        <script src="{{ asset('assets/js/apps.min.js') }}"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->

        <script>
$(document).ready(function () {
    //App.init();
    //Dashboard.init();
});
        </script>

        @stack('script')
    </body>

</html>
