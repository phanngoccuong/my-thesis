@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thêm môn học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý môn học</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm môn học</a></li>
                    </ol>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('course/save') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Môn học</label>
                                            <input type="text" class="form-control @error('course_name') is-invalid @enderror"
                                            value="{{ old('course_name') }}" name="course_name" id="course_name">
                                            @error('course_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Khối</label>
                                            <select class="form-control @error('group_id') is-invalid @enderror"
                                             name="group_id" id="group_id">
                                                <option selected disabled>Chọn</option>
                                                    <option value="1">Khối 1</option>
                                                    <option value="2">Khối 2</option>
                                                    <option value="3">Khối 3</option>
                                                    <option value="4">Khối 4</option>
                                                    <option value="5">Khối 5</option>
                                            </select>
                                            @error('group_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Tính điểm</label>
                                            <select class="form-control @error('is_point') is-invalid @enderror"
                                             name="is_point" id="is_point">
                                                <option selected disabled>Chọn</option>
                                                    <option value="1">Có</option>
                                                    <option value="0">Không</option>
                                            </select>
                                            @error('is_point')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                        <button type="submit" class="btn btn-light">Hủy</button>
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
