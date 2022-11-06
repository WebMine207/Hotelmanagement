@extends('layouts.auth')
@section('title','Login')
@section('content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="loginForm" method="post" action="{{ route('login') }}">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Log In to Backend</h1>
                </div>
                <!--begin::Heading-->
                @include('components.alerts')
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                    <!--begin::Input-->
                    <input placeholder="Email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text" name="email" autofocus autocomplete="off" value="{{old('email')}}"  data-parsley-required="true" data-parsley-type="email" data-parsley-errors-container="#email-errors" data-parsley-required-message="{{ __('Please enter email') }}"/>
                    <span class="text-danger" id="email-errors"></span>
                    @error('email')
                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="email" data-validator="emailAddress">{{$message}}</div></div>
                    @enderror
                    <!--end::Input-->
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                    </div>
                    <!--begin::Input-->
                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" placeholder="Password" data-parsley-required="true"
                    data-parsley-required-message="{{ __('Please enter password') }}" data-parsley-errors-container="#password-errors"/>
                    <span class="text-danger" id="password-errors"></span>
                    @error('password')
                    <div class=" invalid-feedback"><div >{{$message}}</div></div>
                    @enderror
                    <!--end::Input-->
                    <a href="{{ route('password.request') }}"> Forgot password ?</a>
                </div>
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" tabindex="3" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Continue</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end::Form-->
            <a href="{{ route('register') }}" class="text-center">Create Account</a>
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
@section('external-scripts')
<script src="{{ asset('assets/custom/js/login.js')}}"></script>
@endsection
