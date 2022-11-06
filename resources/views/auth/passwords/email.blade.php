@extends('layouts.auth')
@section('title','Forgot password')
@section('content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100" action="{{ route('password.email') }}" method="post">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Forgot Password</h1>
                </div>
                <!--begin::Heading-->
                @include('components.alerts')
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                    <!--begin::Input-->
                    <input placeholder="Email" tabindex="1" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text" name="email" autofocus autocomplete="off" value="{{old('email')}}" />
                    @error('email')
                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="email" data-validator="emailAddress">{{$message}}</div></div>
                    @enderror
                    <!--end::Input-->
                </div>
               
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" tabindex="3" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Send reset link</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end::Form-->
            <a href="{{ route('login') }}">Login</a>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
        <!--begin::Links-->
        <div class="d-flex flex-center fw-bold fs-6">
           {!! footer_title() !!}
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>


@endsection



<!--  <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="h1"><b>{{ config('app.name',"Hotel Management") }}</b></a>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                    </div>
                </form>
            -->
  