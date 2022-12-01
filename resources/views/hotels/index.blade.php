@extends('layouts.app')
@section('tab_title','Hotels list')
@section('title')
<li class="breadcrumb-item text-dark"> {{'Hotels list'}}</li>
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
                <div class="card-header d-block w-100">
                    <div class="card-title d-block w-100">
                        <div class="row">
                            <!--begin::Search-->
                            <div class="col-md-3 mt-1">
                                <label>Search</label>
                                <div class=" position-relative my-1">
                                    <!--begin::Svg Icon -->
                                    <span class="svg-icon svg-icon-1 position-absolute mt-4 mx-2"><i class="fas fa-search"></i></span>
                                    <!--end::Svg Icon-->
                                    <form id="filter_form" action="{{route('hotels.index')}}" method="GET">
                                        <input type="hidden" name="status" class="input-sm form-control" id="form-status">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="hidden" name="owner" id="form-owner">
                                        <input type="hidden" name="hotel_type" value="" id="form-hotel_type">
                                        <input type="text" name="search_keyword" class="form-control form-control-solid w-230px ps-14 py-6" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            <div class="col-md-3 mt-2">
                                <label>Hotel Type</label>
                                <select name="hotel_type" id="hotel_type" class="form-select form-select-solid" data-control="select2"  data-hide-search="true"
                                    title="Hotel Type Filter">
                                    <option value="">All</option>
                                    <option value="motel">Motel</option>
                                    <option value="resort">Resort</option>
                                    <option value="boutique">Boutique</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label>Owner</label>
                                <select name="owner" id="owner" class="form-select form-select-solid" data-control="select2"  data-hide-search="true"
                                    title="Hotel owner Filter">
                                    <option value="">All</option>
                                    @foreach($owners  as $owner)
                                        <option value="{{$owner->id}}">{{ ucfirst($owner->full_name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                            <label>Status</label>
                                <select name="status" id="status" class="form-select form-select-solid" data-control="select2"  data-hide-search="true"
                                    title="Status Filter">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-3">
                               
                            </div>
                            <div class="col-md-1 mx-4 mt-8">
                                <button type="button" class="btn btn-secondary" id="reset_filter_btn">Reset</button>
                            </div>
                        </div>
                        <hr class='text-muted'>
                        <div style="text-align: end;">
                            <a  class="btn btn-primary" href="{{ route('hotels.create') }}"> {{'+ Add '}}</a>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive" id="load_content">
                    <!--begin::Table-->
                    @include('components.hotels_table')
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
@section('external-scripts')

@endsection