@extends('layouts.app')
@if(isset($Hotel))
    @section('tab_title','Edit Hotel')
@else
    @section('tab_title','Add Hotel')
@endif
@section('title')
    <li class="breadcrumb-item text-muted"><a href="{{ route('hotels.index') }}">{{'Hotels list'}}</a> &nbsp;{{' - '}}</li>
    @if(isset($Hotel))
        <li class="breadcrumb-item text-dark"> {{'Edit'}}</li>
    @else
        <li class="breadcrumb-item text-dark"> {{'Add'}}</li>
    @endif
@endsection
@section('content')
@if(isset($hotel))
    {{ Form::model($hotel, ['route' => ['hotels.update', $hotel->id], 'method' => 'patch', 'enctype'=>'multipart/form-data', 'id' => "editHotelForm", 'class' => "data-parsley-validate"]) }}
@else
    {{ Form::open(['route' => 'hotels.store' , 'enctype'=>'multipart/form-data' , 'id' => "addHotelForm" , 'class' => "data-parsley-validate"]) }}
@endif
@csrf
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <div class="row g-5 g-xl-8">
            <!--begin::hotel details column-->
            <div class="col-xl-12">
                <!--begin::2nd column-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="py-5">Basic Details :</h3>
                                                <!-- Name -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Name</label>
                                                    {{ Form::text('name',Request::old('name'),array('class'=>"form-control form-control-solid py-6", "data-parsley-required" => "true", "data-parsley-errors-container" => "#name-errors" ,"data-parsley-required-message" => __('Please enter hotel name') ,'placeholder' => __('Title') )) }}
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <!-- end-Name -->

                                                <!-- owner first name -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Owner first name</label>
                                                    {{ Form::text('first_name',Request::old('first_name'),array('class'=>"form-control form-control-solid py-6", "data-parsley-required" => "true", "data-parsley-errors-container" => "#first-name-errors" ,"placeholder" => "Owner first name","data-parsley-required-message" => __('Enter Owner first name') )) }}
                                                    <span class="text-danger" id="first-name-errors"></span>
                                                        @if ($errors->has('first_name'))
                                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                        @endif
                                                </div>
                                                <!-- end-owner first name -->

                                                 <!-- owner first name -->
                                                 <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Owner last name</label>
                                                    {{ Form::text('last_name',Request::old('last_name'),array('class'=>"form-control form-control-solid py-6", "data-parsley-required" => "true", "data-parsley-errors-container" => "#last-name-errors" , "placeholder" => "Owner last name","data-parsley-required-message" => __('Enter Owner last name') )) }}
                                                    <span class="text-danger" id="last-name-errors"></span>
                                                        @if ($errors->has('last_name'))
                                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                        @endif
                                                </div>
                                                <!-- end-owner first name -->

                                                <!-- email -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Email</label>
                                                    {{ Form::email('email',Request::old('email'),array('class'=>"form-control form-control-solid py-6", "data-parsley-required" => "true", "data-parsley-errors-container" => "#email-errors" ,"data-parsley-required-message" => __('Please enter hotel email') , "data-parsley-type" => "email", 'placeholder' => __('Email') , "data-parsley-required-message" => __('Email is required') )) }}
                                                    <span class="text-danger" id="email_error"></span>
                                                        @if ($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                </div>
                                                <!-- end-email -->

                                                <!-- password -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel password</label>
                                                    <input tabindex="2" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" placeholder="Password" data-parsley-required="true" data-parsley-required-message="{{ __('Enter password') }}" data-parsley-errors-container="#password-errors"/>
                                                    <span class="text-danger" id="password-errors"></span>
                                                    @error('password')
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @enderror
                                                </div>
                                                <!-- end-password -->

                                                <!-- Mobile -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Mobile Number</label>
                                                        <div class="row">
                                                            <div class="col-md-3 p-0">
                                                                <select name="phone_code" id='phone_code' class="form-select form-select-solid" data-control="select2">
                                                                    @foreach($phone_codes as $code)
                                                                        <option value="{{ $code->id }}" @if($code->id == '103') selected @endif > {{ '+ '. $code->phone }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{Form::number('mobile_number',Request::old('mobile_number'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#mobile-number-errors" ,"data-parsley-required-message" => __('Please enter mobile number'),'placeholder' => __('Mobile number') ))}}
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="mobile-number-errors"></span>
                                                        @if ($errors->has('mobile_number'))
                                                            <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                                                        @endif
                                                    </div>
                                                <!-- end-Mobile -->

                                             <!--begin::hotel_type-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">Hotel Type</span>
                                                    </label>
                                                        <select name="hotel_type" id='hotel_type' class="form-select form-select-solid"  data-hide-search="true" data-parsley-required="true" data-control="select2">
                                                            <option value="{{'1'}}"> {{ 'Motel'}}</option>
                                                            <option value="{{'2'}}"> {{ 'Resort'}}</option>
                                                            <option value="{{'3'}}"> {{ 'Boutique'}}</option>
                                                        </select>
                                                        @if ($errors->has('hotel_type'))
                                                                <span class="text-danger">{{ $errors->first('hotel_type') }}</span>
                                                        @endif
                                                </div>
                                                <!--end::hotel_type --> 

                                                <!-- description -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Description</span>
                                                    </label>
                                                    {{Form::textarea('description', Request::old('description'), array('class'=>"form-control form-control-solid py-6",'rows' => 6,"data-parsley-required" => "true", "data-parsley-errors-container" => "#description-errors" ,"data-parsley-required-message" => __('Please enter hotel description '), 'placeholder' => __('Description'), 'id'=> 'description' ))}}
                                                    <span class="text-danger" id="description-errors"></span>
                                                </div>
                                                <!--end-description -->

                                                <!-- Rooms -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Total Rooms</label>
                                                            {{Form::number('total_room',Request::old('total_room'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#total-room-errors" ,"data-parsley-required-message" => __('Please enter total room'),'placeholder' => __('Total room') ))}}
                                                            <span class="text-danger" id="total-room-errors"></span>
                                                            @if ($errors->has('total_room'))
                                                                <span class="text-danger">{{ $errors->first('total_room') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Guests per room</label>
                                                            {{Form::number('guest',Request::old('guest'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#guest-errors" ,"data-parsley-required-message" => __('Please enter guest'),'placeholder' => __('Guest') ))}}
                                                            <span class="text-danger" id="guest-errors"></span>
                                                            @if ($errors->has('guest'))
                                                                <span class="text-danger">{{ $errors->first('guest') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Bedrooms</label>
                                                            {{Form::number('bedrooms',Request::old('bedrooms'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#bedrooms-errors" ,"data-parsley-required-message" => __('Please enter bedrooms'),'placeholder' => __('Bedrooms') ))}}
                                                            <span class="text-danger" id="bedrooms-errors"></span>
                                                            @if ($errors->has('bedrooms'))
                                                                <span class="text-danger">{{ $errors->first('bedrooms') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Bathrooms</label>
                                                            {{Form::number('bathrooms',Request::old('bathroom'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#bathroom-errors" ,"data-parsley-required-message" => __('Please enter bathroom'),'placeholder' => __('bathroom') ))}}
                                                            <span class="text-danger" id="bathroom-errors"></span>
                                                            @if ($errors->has('bathrooms'))
                                                                <span class="text-danger">{{ $errors->first('bathrooms') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Beds</label>
                                                            {{Form::number('beds',Request::old('beds'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#beds-errors" ,"data-parsley-required-message" => __('Please enter beds'),'placeholder' => __('beds') ))}}
                                                            <span class="text-danger" id="beds-errors"></span>
                                                            @if ($errors->has('beds'))
                                                                <span class="text-danger">{{ $errors->first('beds') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end-Rooms -->

                                            <hr class='text-muted'>
                                            <h3 class="py-5">Image Section</h3>
                                             <!-- Feature Image -->
                                             <div class="fv-row mb-7">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Feature Image</span>
                                                </label>
                                                <div class="px-3 mx-3 text-bold">
                                                    {{ Form::file('feature_image',Request::old('feature_image'),array('class'=>"form-control py-4 h-full w-full" , "multiple" , "accept" => "image/png, image/gif, image/jpeg",'aria-describedby' => "button-addon2")) }}
                                                </div>
                                            </div>
                                            <!-- end- Feature Image -->

                                            <!-- Hotel Images -->
                                             <div class="fv-row mb-7">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Images</span>
                                                </label>
                                                <div class="px-3 mx-3 text-bold">
                                                    {{ Form::file('images[]',Request::old('images'),array('class'=>"form-control py-4 h-full w-full" , "multiple" , "accept" => "image/png, image/gif, image/jpeg",'aria-describedby' => "button-addon2")) }}
                                                </div>
                                            </div>
                                            <!-- end- Hotel Images -->
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="py-5">Address Details</h3>
                                            <!-- Address -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2">Address</label>
                                                {{Form::text('address',Request::old('address'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#address-errors" ,"data-parsley-required-message" => __('Please enter address'),'placeholder' => __('Address') ))}}
                                                <input type="hidden" name="latitude" id="edit_latitude" value="">
                                                <input type="hidden" name="longitude" id="edit_longitude" value="">
                                            </div>
                                            <!-- end-Address -->

                                            <!-- zip code -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">Zip Code</label>
                                                {{Form::number('zip_code',Request::old('zip_code'),array('class'=>"form-control form-control-solid py-6" , "minlength" => '6' , "maxlength" => '8' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#zip-code-errors" ,"data-parsley-required-message" => __('Please enter zip code'),'placeholder' => __('Zip code') ))}}
                                                <span class="text-danger" id="zip-code-errors"></span>
                                                @if ($errors->has('zip_code'))
                                                    <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                                                @endif
                                            </div>
                                            <!-- end-zip code -->

                                            <!-- city -->
                                             <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">City</label>
                                                {{Form::text('city',Request::old('city'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#city-errors" ,"data-parsley-required-message" => __('Please enter city'),'placeholder' => __('city') ))}}
                                                <span class="text-danger" id="city-errors"></span>
                                                @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                            <!-- end-city -->

                                            <!-- state -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">State</label>
                                                {{Form::text('state',Request::old('state'),array('class'=>"form-control form-control-solid py-6" , "data-parsley-required" => "true","data-parsley-errors-container" => "#state-errors" ,"data-parsley-required-message" => __('Please enter state'),'placeholder' => __('state') ))}}
                                                <span class="text-danger" id="state-errors"></span>
                                                @if ($errors->has('state'))
                                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                                @endif 
                                            </div>
                                            <!-- end-state -->

                                             <!-- country dropdown -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Country</span>
                                                </label>
                                                    <select name="country" class="form-select form-select-solid address" data-control="select2">
                                                    @foreach($phone_codes as $code)
                                                        <option value="{{ $code->name }}" @if($code->id == '103') selected @endif > {{ $code->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <hr class='text-muted'>
                                            <!-- end-country dropdown -->


                                            <h3 class="py-5">Price Details</h3>
                                                <!-- price section -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                        <label class="required fs-6 fw-bold mb-2">Basic Price</label>
                                                        {{Form::number('price',Request::old('price'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#price-errors" ,"data-parsley-required-message" => __('Please enter basic price'),'placeholder' => __('price') ))}}
                                                        <span class="text-danger" id="price-errors"></span>
                                                        @if ($errors->has('price'))
                                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                                        @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Discount Price</label>
                                                            {{Form::number('discount_price',Request::old('discount_price'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#discount_price-errors" ,"data-parsley-required-message" => __('Please enter basic discount price'),'placeholder' => __('Discount price') ))}}
                                                            <span class="text-danger" id="discount_price-errors"></span>
                                                            @if ($errors->has('discount_price'))
                                                                <span class="text-danger">{{ $errors->first('discount_price') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Weekend Base Price</label>
                                                            {{Form::number('weekend_base_price',Request::old('weekend_base_price'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#weekend_base_price-errors" ,"data-parsley-required-message" => __('Please enter weekend base price'),'placeholder' => __('Weekend Base Price') ))}}
                                                            <span class="text-danger" id="weekend_base_price-errors"></span>
                                                            @if ($errors->has('weekend_base_price'))
                                                                <span class="text-danger">{{ $errors->first('weekend_base_price') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Extra Person Fee</label>
                                                            {{Form::number('extra_person_fee',Request::old('extra_person_fee'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#extra-person-fee-errors" ,"data-parsley-required-message" => __('Please enter extra person fee'),'placeholder' => __('Extra Person Fee') ))}}
                                                            <span class="text-danger" id="extra-person-fee-errors"></span>
                                                            @if ($errors->has('extra_person_fee'))
                                                                <span class="text-danger">{{ $errors->first('extra_person_fee') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Convenience_charge </label>
                                                            {{Form::number('convenience_charge',Request::old('convenience_charge'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#convenience-charge-errors" ,"data-parsley-required-message" => __('Enter extra person fee'),'placeholder' => __('Extra Person Fee') ))}}
                                                            <span class="text-danger" id="convenience-charge-errors"></span>
                                                            @if ($errors->has('convenience_charge'))
                                                                <span class="text-danger">{{ $errors->first('convenience_charge') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Security Deposit Fee</label>
                                                            {{Form::number('security_deposit_fee',Request::old('security_deposit_fee'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#security-deposit-fee-errors" ,"data-parsley-required-message" => __('Enter security deposit fee'),'placeholder' => __('Security deposit fee') ))}}
                                                            <span class="text-danger" id="security-deposit-fee-errors"></span>
                                                            @if ($errors->has('security_deposit_fee'))
                                                                <span class="text-danger">{{ $errors->first('security_deposit_fee') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Goods & Service Tax</label>
                                                            {{Form::number('good_and_service_tax',Request::old('good_and_service_tax'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#good-and-service-tax-errors" ,"data-parsley-required-message" => __('Enter good & service tax'),'placeholder' => __('good & service tax') ))}}
                                                            <span class="text-danger" id="good-and-service-tax-errors"></span>
                                                            @if ($errors->has('good_and_service_tax'))
                                                            <span class="text-danger">{{ $errors->first('good_and_service_tax') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                        <label class="required fs-6 fw-bold mb-2">Cancelation Charge</label>
                                                        {{Form::number('cancelation_charge',Request::old('cancelation_charge'),array('class'=>"form-control form-control-solid py-6" , "maxlength" => '4' ,"data-parsley-required" => "true","data-parsley-errors-container" => "#cancelation-charge-errors" ,"data-parsley-required-message" => __('Enter cancelation charge'),'placeholder' => __('cancelation charge') ))}}
                                                        <span class="text-danger" id="cancelation-charge-errors"></span>
                                                        @if ($errors->has('cancelation_charge'))
                                                            <span class="text-danger">{{ $errors->first('cancelation_charge') }}</span>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end-price section -->


                                                <hr class='text-muted'>
                                                <h3 class="py-5">Polices</h3>
                                                <!-- refunds -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Refunds</span>
                                                    </label>
                                                    {{Form::textarea('refunds', Request::old('refunds'), array('class'=>"form-control form-control-solid py-6",'rows' => 2, 'placeholder' => __('Refunds Policy'), 'id'=> 'refunds' ))}}
                                                </div>
                                                <!--end-refunds -->
                                                <!-- cancellation -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Cancellation</span>
                                                    </label>
                                                    {{Form::textarea('cancellation', Request::old('cancellation'), array('class'=>"form-control form-control-solid py-6",'rows' => 2, 'placeholder' => __('cancellation Policy'), 'id'=> 'cancellation' ))}}
                                                </div>
                                                <!--end-cancellation -->
                                                <!-- common_note -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Common Note</span>
                                                    </label>
                                                    {{Form::textarea('common_note', Request::old('common_note'), array('class'=>"form-control form-control-solid py-6",'rows' => 2, 'placeholder' => __('Common note'), 'id'=> 'common_note' ))}}
                                                </div>
                                                <!--end-common_note -->

                                        </div>


                                        <div class="col-md-12">
                                            <div class="fv-row mt-5">
                                            </div>
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                            <div class="fv-row mt-5 d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <a href="{{ route('hotels.index') }}" class="btn btn-light me-3">Cancel</a>
                                                <button type="submit" id="add_hotel_form_submit" data-kt-banner-action="submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--End::Button-->
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Add hotel-->
        </div>
    </div>
</div>
@endsection

@section('external-scripts')
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js?v=' . time()) }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/custom/hotel.js')}}"></script>
@endsection
