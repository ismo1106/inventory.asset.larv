<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>401 | Access Denied</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="{{ asset('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/style-responsive.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
        <!-- ================== END BASE JS ================== -->
    </head>
    <body class="pace-top">
        <!-- begin #page-loader -->
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="fade">
            <!-- begin error -->
            <div class="error">
                <div class="error-code m-b-10">401 <i class="fa fa-warning"></i></div>
                <div class="error-content">
                    <div class="error-message">Oops! Access Denied...</div>
                    <div class="error-desc m-b-20">
                        The request has not been applied because it lacks valid authentication credentials for the target resource
                    </div>
                    <div>
                        <a href="{{ url('/') }}" class="btn btn-success">Go Back to Home Page</a>
                    </div>
                </div>
            </div>
            <!-- end error -->

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
        <script src="{{ asset('assets/js/apps.min.js') }}"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->

        <script>
$(document).ready(function () {
    App.init();
});
        </script>
    </body>
</html>
