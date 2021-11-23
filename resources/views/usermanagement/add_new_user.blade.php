
@extends('layouts.st_master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
    @include('sidebar.sidebar')


    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Add New User</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">User</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Add New User</a></li>
                    </ol>
                </div>
            </div>

            <div class="authincation h-100">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-md-6">
                            <div class="authincation-content">
                                <div class="row no-gutters">
                                    <div class="col-xl-12">
                                        <div class="auth-form">
                                            <h4 class="text-center mb-4">Create new account</h4>
                                            <form method="POST" action="{{ route('user/add/save') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label><strong>Username</strong></label>
                                                    <input type="text" class="form-control @error('name') is-invalid
                                                    @enderror" name="name"  placeholder="Enter Your Name">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label><strong>Image</strong></label>
                                                    <input class="form-control @error('image') is-invalid @enderror"
                                                    name="image" type="file" id="image" multiple="">
                                                    @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label><strong>Email</strong></label>
                                                    <input type="email" class="form-control
                                                    @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label><strong>Phone Number</strong></label>
                                                    <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter Your Phone Number">
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label><strong>Role Name</strong></label>
                                                    <select class="form-control @error('role_name') is-invalid @enderror"
                                                    name="role_name" id="role_name">
                                                        <option selected disabled>Select Role Name</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Teacher">Teacher</option>
                                                    </select>
                                                @error('role_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label><strong>Password</strong></label>
                                                    <input type="password" class="form-control
                                                    @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label><strong>Confirm Password</strong></label>
                                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Choose Confirm Password">
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
