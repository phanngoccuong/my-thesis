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
                        <h4>Cập nhật người dùng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý người dùng</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Cập nhật người dùng</a></li>
                    </ol>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Họ và tên</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                          name="name"
                                                        value="{{ $data->name }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="email" class="form-control"
                                                    placeholder="Email"
                                                    name="email" value="{{ $data->email }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <label>Vai trò</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group position-relative has-icon-left">
                                                <select class="form-control" name="role_name" id="role_name">
                                                    <option value="Admin"
                                                        {{ ( $data->role_name == "Admin") ? 'selected' : ''}}>
                                                      Admin
                                                    </option>
                                                    <option value="Student"
                                                        {{ ( $data->role_name == "Student") ? 'selected' : ''}}>
                                                      Học sinh
                                                    </option>
                                                    <option value="Teacher"
                                                        {{ ( $data->role_name == "Teacher") ? 'selected' : ''}}>
                                                      Giáo viên
                                                    </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1">Cập nhật</button>
                                                <a  href="{{ route('userManagement') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Trở lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
