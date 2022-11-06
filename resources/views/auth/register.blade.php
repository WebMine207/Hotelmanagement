@extends('layouts.auth')
@section('title','Create account')
@section('content')
<div class="d-flex flex-column flex-lg-row-fluid py-10">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="w-lg-700px p-5 p-lg-10 mx-10">
            <!--begin::Form-->
            <form method="post" action="{{ route('register') }}">
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
                        <input placeholder="First name" tabindex="1" class="form-control form-control-lg form-control-solid @error('first_name') is-invalid @enderror" type="text" name="first_name" autofocus autocomplete="off" value="{{old('first_name')}}" />
                        @error('first_name')
                             <div class="fv-plugins-message-container invalid-feedback"><div data-field="first_name">{{$message}}</div></div>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label fw-bolder text-dark fs-6">Last Name</label>
                        <input placeholder="last name" tabindex="1" class="form-control form-control-lg form-control-solid @error('last_name') is-invalid @enderror" type="text" name="last_name" autofocus autocomplete="off" value="{{old('last_name')}}" />
                        @error('last_name')
                            <div class="fv-plugins-message-container invalid-feedback"><div data-field="last_name">{{$message}}</div></div>
                        @enderror
                    </div>
                </div>
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                    <input placeholder="Email" tabindex="1" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text" name="email" autofocus autocomplete="off" value="{{old('email')}}" />
                    @error('email')
                    <div class="fv-plugins-message-container invalid-feedback"><div data-field="email" data-validator="emailAddress">{{$message}}</div></div>
                    @enderror
                </div>
                <div class="fv-row mb-7">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                    </div>
                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" placeholder="Password"/>
                    @error('password')
                    <div class=" invalid-feedback"><div >{{$message}}</div></div>
                    @enderror
                </div>
                 <div class="fv-row mb-7">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">Confirm Password</label>
                    </div>
                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="off" placeholder="Confirm password"  />
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
           {!! footer_title() !!}
        </div>
    </div>
    <!--end::Footer-->
</div>    
@endsection

<!-- <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control " placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                         /.col -->
                        <!-- <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div> -->
                        <!-- /.col -->
                    <!-- </div> -->
                <!-- </form> --> 