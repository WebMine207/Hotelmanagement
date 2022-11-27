@extends('layouts.auth')
@section('title','Create account')
@section('content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-700px p-5 p-lg-10 mx-10">
            <!--begin::Form-->
            <form method="post" class="RegisterForm" action="{{ route('register') }}">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <h1 class="text-dark mb-3">Create Account</h1>
                </div>
                <!--begin::Heading-->
                @include('components.alerts')
                <div class="row fv-row mb-5">
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">First Name</label>
                        <input placeholder="First name" tabindex="1" class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror" type="text" name="first_name" autofocus autocomplete="off" value="{{old('first_name')}}" data-parsley-required="true" data-parsley-type="first_name" data-parsley-errors-container="#first-name-errors" data-parsley-required-message="{{ __('Enter your first name') }}"/>
                        <span class="text-danger" id="first-name-errors"></span>
                        @error('first_name')
                             <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name">{{$message}}</div></div>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Last Name</label>
                        <input placeholder="last name" tabindex="1" class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" type="text" name="last_name" autofocus autocomplete="off" value="{{old('last_name')}}" data-parsley-required="true" data-parsley-type="last_name" data-parsley-errors-container="#last-name-errors" data-parsley-required-message="{{ __('Enter your last name') }}"/>
                        <span class="text-danger" id="last-name-errors"></span>
                        @error('last_name')
                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name">{{$message}}</div></div>
                        @enderror
                    </div>
                </div>
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                    <input placeholder="Email" tabindex="1" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text" name="email" autofocus autocomplete="off" value="{{old('email')}}" data-parsley-required="true" data-parsley-type="email" data-parsley-errors-container="#email-errors" data-parsley-required-message="{{ __('Enter your email address') }}"/>
                    <span class="text-danger" id="email-errors"></span>
                    @error('email')
                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="email" data-validator="emailAddress">{{$message}}</div></div>
                    @enderror
                </div>
                <div class="fv-row mb-7">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                    </div>
                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="off" placeholder="Password"  data-parsley-required="true"
                    data-parsley-required-message="{{ 'Please enter password' }}" data-parsley-errors-container="#password-errors" minlength="8"  data-parsley-special="1" data-parsley-minlength-message="{{'Password must have at least 8 characters' }}"  data-parsley-special-message="{{ 'The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Special Character, 1 Numeric Value.'}}"/>
                    <span class="text-danger" id="password-errors"></span>
                    @error('password')
                    <div class=" invalid-feedback"><div >{{$message}}</div></div>
                    @enderror
                </div>
                 <div class="fv-row mb-7">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Confirm Password</label>
                    </div>
                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="off" placeholder="Confirm password" data-parsley-required="true" data-parsley-errors-container="#password-confirmation-errors" data-parsley-required-message="{{'Please enter confirm password'}}" data-parsley-equalto-message="{{'The passwords you entered do not match'}}" data-parsley-equalto="#password" />
                    <span class="text-danger" id="password-confirmation-errors"></span>
                    @error('password_confirmation')
                    <div class="invalid-feedback"><div >{{$message}}</div></div>
                    @enderror
                </div>
                <div class="text-center mt-7">
                    <!--begin::Submit button-->
                    <button type="submit" tabindex="3" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end::Form-->
            <div class="text-align-center">
                <a href="{{ route('login') }}">Log in</a>
            </div>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
        <div class="d-flex flex-center fw-bold fs-6">
            {{'Copyright'}} &copy; {{  date('Y').' ' . env('APP_NAME'). ' All rights reserved. '}}
        </div>
    </div>
    <!--end::Footer-->
</div>    
@endsection
@section('external-scripts')
<script src="{{ asset('assets/custom/js/login.js')}}"></script>
@endsection