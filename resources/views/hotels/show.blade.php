@extends('layouts.layout')
@section('title','Edit Hotels')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hotel Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Hotel Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Hotel</h3>
                    </div>
                    <div class="card-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="username" value="{{ $hotel->name ?? "" }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="userStatus">Status</label>
                                <select id="userStatus" name="status" class="form-control custom-select" readonly>
                                    <option selected disabled>Select one</option>
                                    <option value="1" {{ $hotel->status==1 ? "selected" :"" }}>Active</option>
                                    <option value="2" {{ $hotel->status==2 ? "selected" :"" }}>Inactive</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('hotels.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
@endsection
@section('script')
@endsection
