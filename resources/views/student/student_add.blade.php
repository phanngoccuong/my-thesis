@extends('layouts.st_master')

@section('content')
@include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thêm học sinh mới</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý học sinh </a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm học sinh mới</a></li>
                    </ol>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('student.save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên đệm</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}" name="last_name" id="last_name">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Tên</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}" name="first_name" id="first_name">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email" id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Niên khóa</label>
                                            <select class="form-control @error('batch_id') is-invalid @enderror"
                                             name="batch_id" id="batch_id">
                                                <option selected disabled>Chọn niên khóa</option>
                                                @foreach ($batches as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('batch_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày sinh</label>
                                            <input type="text" class="form-control datepicker
                                            @error('dateOfBirth') is-invalid @enderror"
                                            name="dateOfBirth" id="dateOfBirth">
                                            @error('dateOfBirth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Lớp</label>
                                            <select class="form-control @error('class_id') is-invalid @enderror"
                                             name="class_id" id="class_id">
                                                <option selected disabled>Chọn lớp</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('class_id')
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
                                            value="{{ old('gender') }}" name="gender" id="gender">
                                                <option selected disabled>Giới tính</option>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
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
                                            <label class="form-label">Họ và tên bố</label>
                                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                             value="{{ old('father_name') }}"
                                             name="father_name" id="father_name">
                                            @error('father_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Số điện thoại bố</label>
                                            <input type="text" class="form-control @error('father_number') is-invalid @enderror"
                                             value="{{ old('father_number') }}" name="father_number" id="father_number">
                                            @error('father_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên mẹ</label>
                                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                             value="{{ old('mother_name') }}"
                                             name="mother_name" id="mother_name">
                                            @error('mother_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Số điện thoại mẹ</label>
                                            <input type="text" class="form-control @error('mother_number') is-invalid @enderror"
                                             value="{{ old('mother_number') }}" name="mother_number" id="mother_number">
                                            @error('mother_number')
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
                                            value="{{ old('address') }}" name="address" id="address" rows="5"></textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-label">Ảnh</label>
                                        <div class="form-group fallback w-100">
                                            <input type="file" class="dropify @error('upload') is-invalid @enderror"
                                            value="{{ old('upload') }}" data-default-file="upload" name="upload" id="upload">
                                            @error('upload')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <input type="hidden" name="session_id" value="{{$currentYearSession_id}}">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
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

