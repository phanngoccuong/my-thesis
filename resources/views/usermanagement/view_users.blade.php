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
                            <form class="form form-horizontal" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data[0]->id }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Họ và tên</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                        placeholder="Name" id="first-name-icon" name="fullName"
                                                        value="{{ $data[0]->name }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Ảnh</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-lefts">
                                                <div class="position-relative">
                                                    <input type="file" class="form-control"
                                                    placeholder="Name" id="first-name-icon" name="image"/>
                                                    <div class="avatar avatar-xl">
                                                        <img class="rounded-circle" width="35"
                                                         src="{{ URL::to('/assets/images/'. $data[0]->avatar) }}">
                                                    </div>
                                                    <input type="hidden" name="hidden_image" value="{{ $data[0]->avatar }}">
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
                                                    placeholder="Email" id="first-name-icon" name="email" value="{{ $data[0]->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Số điện thoại</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="number" class="form-control"
                                                    placeholder="Mobile" name="phone_number" value="{{ $data[0]->phone_number }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Trạng thái</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group position-relative has-icon-left">
                                                <select class="form-control" name="status" id="status">
                                                    <option value="{{ $data[0]->status }}"
                                                        {{ ( $data[0]->status == $data[0]->status) ? 'selected' : ''}}>
                                                        {{ $data[0]->status }}
                                                    </option>
                                                    @foreach ($userStatus as $key => $value)
                                                    <option value="{{ $value->type_name }}">
                                                            {{ $value->type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Vai trò</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group position-relative has-icon-left">
                                                <select class="form-control" name="role_name" id="role_name">
                                                    <option value="{{ $data[0]->role_name }}"
                                                        {{ ( $data[0]->role_name == $data[0]->role_name) ? 'selected' : ''}}>
                                                        {{ $data[0]->role_name }}
                                                    </option>
                                                    @foreach ($roleName as $key => $value)
                                                    <option value="{{ $value->role_type }}"> {{ $value->role_type }}</option>
                                                    @endforeach
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
