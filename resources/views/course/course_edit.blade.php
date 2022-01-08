@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chỉnh sửa môn học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý môn học</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa môn học</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('course/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $courses->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Môn học</label>
                                            <input type="text" class="form-control
                                            @error('course_name') is-invalid @enderror"
                                            value="{{ $courses->course_name }}" name="course_name" id="course_name">
                                            @error('course_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Khối</label>
                                            <select class="form-control @error('group_id') is-invalid @enderror"
                                             name="group_id" id="group_id">
                                                <option selected disabled>Chọn</option>
                                                    <option value="1"
                                                        {{ $courses->id == 1 ? 'selected':''}}>
                                                        Khối 1</option>
                                                        <option value="2"
                                                        {{ $courses->id == 2 ? 'selected':''}}>
                                                        Khối 2</option>
                                                        <option value="3"
                                                        {{ $courses->id == 3 ? 'selected':''}}>
                                                        Khối 3</option>
                                                        <option value="4"
                                                        {{ $courses->id == 4 ? 'selected':''}}>
                                                        Khối 4</option>
                                                        <option value="5"
                                                        {{ $courses->id == 5 ? 'selected':''}}>
                                                        Khối 5</option>
                                            </select>
                                            @error('group_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <button type="button" class="btn btn-light">
                                            <a href="{{ route('course/list') }}">Trở lại</a></button>
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
