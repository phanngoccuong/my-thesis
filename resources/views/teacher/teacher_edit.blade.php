@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chỉnh sửa thông tin giáo viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý giáo viên</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa thông tin giáo viên</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $teachers[0]->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control
                                            @error('teacher_name') is-invalid @enderror"
                                            value="{{ $teachers[0]->teacher_name }}" teacher_name="teacher_name" id="teacher_name">
                                            @error('teacher_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control
                                            @error('email') is-invalid @enderror"
                                            value="{{ $teachers[0]->email }}" name="email" id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Giới tính</label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                             name="gender" id="gender">
                                                <option selected disabled>Gender</option>
                                                <option value="Male"
                                                {{ $teachers[0]->gender == '1' ? 'selected' : '' }}>Nam</option>
                                                <option value="Female"
                                                {{ $teachers[0]->gender == '2' ? 'selected' : '' }}>Nữ</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Số điện thoại</label>
                                            <input type="tel" class="form-control
                                            @error('mobileNumber') is-invalid @enderror"
                                            value="{{ $teachers[0]->mobileNumber }}" name="mobileNumber" id="mobileNumber">
                                            @error('mobileNumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày sinh</label>
                                            <input type="text" class="datepicker form-control
                                            @error('dateOfBirth') is-invalid @enderror"
                                            value="{{ $teachers[0]->dateOfBirth }}" name="dateOfBirth" id="dateOfBirth">
                                            @error('dateOfBirth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Chuyên môn</label>
                                            <input type="text" class="form-control @error('special') is-invalid @enderror"
                                            value="{{ $teachers[0]->special }}" name="special" id="special">
                                            @error('special')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Địa chỉ</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror"
                                            value="{{ $teachers[0]->address }}" name="address" id="address" rows="5">
                                            {{ $teachers[0]->address }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Ảnh</label>
                                        <img class="rounded-circle" width="35" src="{{ URL::to('/images/'. $teachers[0]->upload) }}"
                                        alt="{{ $teachers[0]->upload }}">
                                        <div class="form-group fallback w-100">
                                            <input type="hidden" name="hidden_image" value="{{ $teachers[0]->upload }}">
                                            <input type="file" class="dropify" name="upload" id="upload">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <button type="button" class="btn btn-light"><a href="{{ route('teacher/list') }}">Trở lại</a></button>
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
