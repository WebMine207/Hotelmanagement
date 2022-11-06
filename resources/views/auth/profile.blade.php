@extends('layouts.app')
@section('tab_title','My Profile')
@section('title')
{!! setBreadCrumb('My Profile') !!}
@endsection
@section('content')
<!--begin::Post-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <!--begin::Sign-in Method-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">

                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="Javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$user->first_name}}</a>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Email Address-->
                    <div class="d-flex flex-wrap align-items-center">
                        <!--begin::Label-->
                        <div id="kt_signin_email">
                            <div class="fs-6 fw-bolder mb-1">Email Address</div>
                            <div class="fw-bold text-gray-600">{{ $user->email }}</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Edit-->
                        <div class="flex-row-fluid d-none">
                            <!--begin::Form-->
                            <form action="{{ route('profile.update') }}" class="ProfileUpdateform">
                                @csrf
                                <input type="hidden" name="action" value="change_email">
                                <div class="row mb-6">
                                    <div class="col-lg-6">
                                        <div class="fv-row mb-0">
                                            <label for="name" class="form-label fs-6 fw-bolder mb-3">Name</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" id="name" value="{{ $user->first }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <div class="fv-row mb-0">
                                            <label for="emailaddress" class="form-label fs-6 fw-bolder mb-3">Enter New Email Address</label>
                                            <input type="email" class="form-control form-control-lg form-control-solid" id="email" placeholder="Email Address" name="email" value="{{'mayank@mailinator.com'}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_signin_submit" type="button" class="btn btn-primary me-2 px-6">Update</button>
                                    <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Action-->
                        <div id="kt_signin_email_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary">Change Email</button>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Email Address-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Password-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Label-->
                        <div id="kt_signin_password">
                            <div class="fs-6 fw-bolder mb-1">Password</div>
                            <div class="fw-bold text-gray-600">************</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Edit-->
                        <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                            <!--begin::Form-->
                            <form action="{{route('home',getEncrypted('1'))}}"  class="form" novalidate="novalidate">
                                @csrf
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="currentpassword" class="form-label fs-6 fw-bolder mb-3">Current Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="password" class="form-label fs-6 fw-bolder mb-3">New Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="password_confirmation" class="form-label fs-6 fw-bolder mb-3">Confirm New Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="password_confirmation" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                <div class="d-flex">
                                    <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">Update Password</button>
                                    <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Action-->
                        <div id="kt_signin_password_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Password-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

<!--  <form class="form-horizontal" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="inputName" placeholder="Name" value="{{ Auth::user()->name ?? "" }}">
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Hotel Image</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form> -->