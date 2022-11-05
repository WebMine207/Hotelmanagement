<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME','Hotel Management') }} | @yield('title','Hotel Management')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">--}}
<!-- Ionicons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
<!-- Tempusdominus Bootstrap 4 -->
{{--    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">--}}
<!-- iCheck -->
{{--    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
<!-- JQVMap -->
{{--    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- overlayScrollbars -->
{{--    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">--}}
<!-- Daterange picker -->
{{--    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">--}}
<!-- summernote -->
    {{--    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">--}}
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('profile.index') }}" class="dropdown-item {{ request()->is(['profile']) ? 'active' : '' }}">
                        <i class="fas fa-envelope mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('password.index') }}" class="dropdown-item {{ request()->is(['change_password']) ? 'active' : '' }}">
                        <i class="fas fa-users mr-2"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('/') }}" class="brand-link">
{{--            <img src="dist/img/AdminLTELogo.png" alt="Hotel Management" class="brand-image img-circle elevation-3"--}}
{{--                 style="opacity: .8">--}}
            <span class="brand-text font-weight-light">{{ env('APP_NAME','Hotel Management') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{--                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name ?? "" }}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                @include('layouts.navbar')
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">{{ env('APP_NAME','Hotel Managment') }}</a>.</strong>
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var _token = $("meta[name='_token']").attr('content');
    @if(Session::has('success'))
    toastr.success("{{session('success')}}");
    @endif
    @if(Session::has('error'))
    toastr.error("{{session('error')}}");
    @endif
</script>
@yield('script')
</body>
</html>
