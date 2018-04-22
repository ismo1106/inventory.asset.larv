
<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{ app()->getLocale() }}" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <title>FAST | Login Page</title>
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
    <body class="pace-top bg-white">
        <!-- begin #page-loader -->
        <!--<div id="page-loader" class="fade in"><span class="spinner"></span></div>-->
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="fade">
            <!-- begin login -->
            <div class="login login-with-news-feed">
                <!-- begin news-feed -->
                <div class="news-feed">
                    <div class="news-image">
                        <img src="{{ asset('assets/img/login-bg/bg-7.jpg') }}" data-id="login-cover-image" alt="" />
                    </div>
                    <!-- <div class="news-caption">
                        <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> Announcing the Color Admin app</h4>
                        <p>
                            Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>-->
                </div>
                <!-- end news-feed -->
                <!-- begin right-content -->
                <div class="right-content">
                    <!-- begin login-header -->
                    <div class="login-header">
                        <div class="brand">
                            <span class="logo"></span> FAST
                            <small>Fixed Asset System Technology</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-sign-in"></i>
                        </div>
                    </div>
                    <!-- end login-header -->
                    <!-- begin login-content -->
                    <div class="login-content">
                        <form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
                            {{ csrf_field() }}
                            <div class="form-group m-b-15{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" name="email" class="form-control input-lg" placeholder="Email Address" value="{{ old('email') }}" required />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group m-b-15{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" class="form-control input-lg" placeholder="Password" required />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox m-b-30">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} /> Remember Me
                                </label>
                            </div>
                            <div class="login-buttons">
                                <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                            </div>
                            <!-- <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                                Not a member yet? Click <a href="" class="text-success">here</a> to register.
                            </div>-->
                            <hr />
                            <p class="text-center">
                                &copy; FAST Admin All Right Reserved 2018 - {{ date('Y') }}
                            </p>
                        </form>
                    </div>
                    <!-- end login-content -->
                </div>
                <!-- end right-container -->
            </div>
            <!-- end login -->

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
jQuery(document).ready(function () {
    App.init();
});
        </script>
    </body>

</html>