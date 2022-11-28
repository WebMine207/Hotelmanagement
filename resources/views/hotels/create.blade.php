@extends('layouts.app')
@section('tab_title','Add Hotel')
@section('title')
    <li class="breadcrumb-item text-muted"><a href="{{ route('hotels.index') }}">{{'Hotels list'}}</a> &nbsp;{{' - '}}</li>
    <li class="breadcrumb-item text-dark"> {{'Add'}}</li>
@endsection
@section('content')
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
                                <form class="form" action="{{ route('hotels.store') }}" id="edit_hotel_form" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="py-5">Basic Details :</h3>
                                                <!-- Name -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Name</label>
                                                    <input type="text" class="form-control form-control-solid py-6"
                                                        value="" name="name" placeholder="{{'Name'}}"/>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <!-- end-Name -->

                                                <!-- email -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Email</label>
                                                    <input type="email" class="form-control form-control-solid py-6"
                                                        value="" name="email" placeholder="{{'Email'}}" />
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <!-- end-email -->

                                                <!-- Mobile -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Hotel Mobile Number</label>
                                                        <div class="row">
                                                            <div class="col-md-2 p-0">
                                                                <select name="phone_code" id='phone_code' class="form-select form-select-solid" data-control="select2">
                                                                    @foreach($phone_codes as $code)
                                                                        <option value="{{ $code->id }}" @if($code->id == '103') selected @endif > {{ '+ '. $code->phone }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="text" id="mobile_number" class="form-control form-control-solid py-6" value="" placeholder="{{'Mobile Number'}}" name="mobile_number" />
                                                            </div>
                                                        </div>
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
                                                        <select name="hotel_type" id='hotel_type' class="form-select form-select-solid"  data-hide-search="true" data-control="select2">
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
                                                    <textarea class="form-control description-hight form-control-solid" rows="3" placeholder="Description" name="description" id="description"> </textarea>
                                                </div>
                                                <!--end-description -->

                                                <!-- Rooms -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Total Rooms</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="total_room" placeholder="{{'room'}}"/>
                                                            @if ($errors->has('total_room'))
                                                                <span class="text-danger">{{ $errors->first('total_room') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Guests per room</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="guest" placeholder="{{'Guests'}}"/>
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
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="bedrooms" placeholder="{{'Bedrooms'}}"/>
                                                            @if ($errors->has('bedrooms'))
                                                                <span class="text-danger">{{ $errors->first('bedrooms') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Bathrooms</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="bathroom" placeholder="{{'Bathroom'}}"/>
                                                            @if ($errors->has('bathroom'))
                                                                <span class="text-danger">{{ $errors->first('bathroom') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Beds</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="beds" placeholder="{{'Beds'}}"/>
                                                            @if ($errors->has('beds'))
                                                                <span class="text-danger">{{ $errors->first('beds') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end-Rooms -->

                                            <!-- Status dropdown -->
                                                <!-- <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required ">Approval Status</span>
                                                    </label>
                                                    <div class="px-3 mx-3 text-bold">
                                                        {{ 'Pending' }}
                                                    </div>
                                                </div> -->
                                            <!-- end-Status dropdown -->
                                            <hr class='text-muted'>
                                            <h3 class="py-5">Image Section</h3>
                                             <!-- Feature Image -->
                                             <div class="fv-row mb-7">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Feature Image</span>
                                                </label>
                                                <div class="px-3 mx-3 text-bold">
                                                    <input type="file" name="feature_image" id="feature_image" multiple accept="image/png, image/gif, image/jpeg" require>
                                                </div>
                                            </div>
                                            <!-- end- Feature Image -->

                                            <!-- Hotel Images -->
                                             <div class="fv-row mb-7">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Images</span>
                                                </label>
                                                <div class="px-3 mx-3 text-bold">
                                                    <input type="file" name="images[]" multiple accept="image/png, image/gif, image/jpeg" id="images">
                                                </div>
                                            </div>
                                            <!-- end- Hotel Images -->
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="py-5">Address Details</h3>
                                            <!-- Address -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2">Address</label>
                                                    <input type="text" class="form-control form-control-solid address py-6" id="edit_hotel_location" name="address" placeholder="Address Line 1" />
                                                    <input type="hidden" name="latitude" id="edit_latitude" value="">
                                                    <input type="hidden" name="longitude" id="edit_longitude" value="">
                                            </div>
                                            <!-- end-Address -->

                                            <!-- zip code -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">Zip Code</label>
                                                <input type="text" class="form-control form-control-solid py-6"
                                                    value="" id="zip_code" name="zip_code" placeholder="Zip Code" />
                                            </div>
                                            <!-- end-zip code -->

                                            <!-- city -->
                                             <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">City</label>
                                                <input type="text" class="form-control form-control-solid py-6"
                                                    value="" name="city" placeholder="City"/>
                                            </div>
                                            <!-- end-city -->

                                            <!-- state -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">State</label>
                                                <input type="text" class="form-control form-control-solid py-6"
                                                    value="" name="state" placeholder="State"/>
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
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="price" placeholder="{{'Price'}}"/>
                                                            @if ($errors->has('price'))
                                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Discount Price</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="discount_price" placeholder="{{'discount_price'}}"/>
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
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="weekend_base_price" placeholder="{{'Weekend Base Price'}}"/>
                                                            @if ($errors->has('weekend_base_price'))
                                                                <span class="text-danger">{{ $errors->first('weekend_base_price') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Extra Person Fee</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="extra_person_fee" placeholder="{{'Extra Person Fee'}}"/>
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
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="convenience_charge" placeholder="{{'Convenience Charge'}}"/>
                                                            @if ($errors->has('convenience_charge'))
                                                                <span class="text-danger">{{ $errors->first('convenience_charge') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Security Deposit Fee</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="security_deposit_fee" placeholder="{{'Security Deposit Fee'}}"/>
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
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="good_and_service_tax" placeholder="{{'Goods & Service Tax'}}"/>
                                                                @if ($errors->has('good_and_service_tax'))
                                                                    <span class="text-danger">{{ $errors->first('good_and_service_tax') }}</span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="fv-row mb-7 form-group">
                                                            <label class="required fs-6 fw-bold mb-2">Cancelation Charge</label>
                                                            <input type="number" class="form-control form-control-solid py-6"
                                                                name="cancelation_charge" placeholder="{{'Cancelation Charge'}}"/>
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
                                                    <textarea class="form-control form-control-solid" rows="2" placeholder="Refunds Policy" name="refunds" id="refunds"> </textarea>
                                                </div>
                                                <!--end-refunds -->
                                                <!-- cancellation -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Cancellation</span>
                                                    </label>
                                                    <textarea class="form-control form-control-solid" rows="2" placeholder="Cancellation Policy" name="cancellation" id="cancellation"> </textarea>
                                                </div>
                                                <!--end-cancellation -->
                                                <!-- common_note -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Common Note</span>
                                                    </label>
                                                    <textarea class="form-control form-control-solid" rows="2" placeholder="Common Note" name="common_note" id="common_note"> </textarea>
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
                                                <button type="submit" disabled  id="add_hotel_form_submit" data-kt-banner-action="submit"
                                                    class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--End::Button-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
