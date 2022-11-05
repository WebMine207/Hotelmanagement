@extends('layouts.layout')
@section('title','Edit Users')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Edit</li>
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
                        <h3 class="card-title">User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update',$user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="username" value="{{ $user->name ?? "" }}" class="form-control @error('username') is-invalid @enderror">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ $user->email ?? "" }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="userStatus">Status</label>
                                <select id="userStatus" name="status" class="form-control custom-select @error('status') is-invalid @enderror">
                                    <option selected disabled>Select one</option>
                                    <option value="1" {{ $user->status==1 ? "selected" :"" }}>Active</option>
                                    <option value="2" {{ $user->status==2 ? "selected" :"" }}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                                    <input type="submit" value="Update User" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>

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
