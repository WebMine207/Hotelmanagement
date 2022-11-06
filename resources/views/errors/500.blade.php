<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="{{ url('') }}">
    <title>{{ config('app.name', 'Hotel Management') }} | Error 500 </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon"  href="{{ asset('img/blue_favicon.png') }}" />
    <!--begin::Fonts-->
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/backend_style.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root" style="background-color: #FFF">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
				<!--begin::Illustration-->
				<img src="{{ asset('img/404.png') }}" alt="" class="mw-100 mb-10 custom-hight-404" />
				<!--end::Illustration-->
				<!--begin::Message-->
				<h3 class="fw-bold mb-10" style="color: #A3A3C7">Error - 500</h3>
                <h1 class="fw-bold mb-10" style="color: #A3A3C7">Seems there is nothing here</h1>
				<!--end::Message-->
				<!--begin::Link-->
				<a href="{{route('home')}}" class="btn btn-primary">Return Home</a>
				<!--end::Link-->
			</div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
</body>
</html>