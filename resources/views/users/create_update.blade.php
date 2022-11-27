@extends('layouts.app')
@section('tab_title','Users create')
@section('title')
<li class="breadcrumb-item text-dark">{{'Edit Users'}}</li>
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <!--begin::sub category Row-->
        <div class="row g-xl-8">
            <!--begin:: column-->
            <div class="col-xl-8">
                <!--begin::sub category-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="fw-bolder text-dark">Edit User</span>
                                </h3>
                                <form class="form" action="{{route('users.update',$user->id)}}" id="edit_users_form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                         <!--first Name -->
                                        <div class="fv-row mb-4 col-lg-6">
                                            <label class="required fs-6 fw-bold mb-2">First Name</label>
                                            <input type="text" class="form-control form-control-solid" id="first_name" placeholder="" value="{{$user->first_name}}" name="first_name"/>
                                            @if ($errors->has('name'))
                                            <div class="error">
                                                <strong>{{ $errors->first('first_name') }}</strong></div>
                                            @endif
                                        </div>
                                        <!-- end-first Name -->
                                        <!--last Name -->
                                        <div class="fv-row mb-4 col-lg-6">
                                            <label class="required fs-6 fw-bold mb-2">Last Name</label>
                                            <input type="text" class="form-control form-control-solid" id="last_name" placeholder="" value="{{$user->last_name}}" name="last_name"/>
                                            @if ($errors->has('last_name'))
                                            <div class="error">
                                                <strong>{{ $errors->first('last_name') }}</strong></div>
                                            @endif
                                        </div>
                                        <!-- end-last Name -->                            
                                     </div>
                                    
                                    <!-- Email -->
                                    <div class="fv-row mb-4">
                                        <label class="required fs-6 fw-bold mb-2">
                                            <span >Email</span>
                                        </label>
                                        <input type="email" id="email" class="form-control form-control-solid" readonly value="{{$user->email}}" placeholder="" name="email" />
                                        @if ($errors->has('email'))
                                        <div class="error">
                                            <strong>{{ $errors->first('email') }}</strong></div>
                                        @endif
                                    </div>
                                    <!--end-Email -->

                                    <!-- mobile_number -->
                                    <div class="fv-row mb-4">
                                        <label class="fs-6 fw-bold mb-2">
                                            <span class="required">Mobile Number</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-3 pl-0">
                                                <select name="phone_code" id='phone_code' class="form-select form-select-solid" data-control="select2">
                                                    @foreach ($phoneCode as $value)
                                                        <option value="{{ $value->phone }}" {{ $value->phone == $user->phone_code ? 'selected' : '' }}>
                                                            {{ '+'. $value->phone }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="mobile_number" id="mobile_number" class="form-control form-control-solid mobile_input_mask" value="{{$user->mobile_number}}" placeholder="" />
                                                @if ($errors->has('mobile_number'))
                                                <div class="error">
                                                    <strong class='text-danger'>{{ $errors->first('mobile_number') }}</strong></div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <!--end-mobile_number -->

                                    <div class="fv-row my-15 text-right">
                                        <!--begin::Button-->
                                        <input type="submit" id="edit_users_form_submit" data-kt-banner-action="update" value="Update" class="btn btn-primary">
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <a href="{{route('users.index')}}" class="btn btn-light me-3">Cancel</a>

                                    </div>
                                </form>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::sub category-->
            </div>
            <!--end:: column-->
        </div>
        <!--end::sub category Row-->
    </div>
</div>
@endsection
@section('external-scripts')
<script>
    var id='{{$user->id}}';

        $("#edit_users_form").validate({
        rules: {
            first_name: {
                required:true ,
                noSpace:true,
            },
            last_name: {
                required:true ,
                noSpace:true,
            },
            country_code:{
                required:true ,
            },
            email: {
                checkemail:true,
				required: true,
	            mobile_number: {
                required:true ,
                input_mask_mobile_number:true,
            },
        },
        messages: {
            first_name: 'Please enter first name',
            last_name: 'Please enter last name',
            email:{
                required:"Please enter email",
                remote:"Email is already exists",
                checkemail:"Please enter valid email",
            },
            mobile_number: {
                required:"Please enter mobile number",
                input_mask_mobile_number:"Please enter a valid number",
            },
            phone_code:{
                required:"Please choose any country code",
            }
        },
        submitHandler: function (form) {
            return true;
        },
        success: function(label,element) {
            label.parent().removeClass('has-danger');
        },
    });
</script>
@endsection