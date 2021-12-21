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
                        <h4>Chỉnh sửa thông tin học sinh</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý học sinh</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa thông tin học sinh</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('student/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $student[0]->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control
                                            @error('name') is-invalid @enderror"
                                            value="{{ $student[0]->name }}" name="name" id="name">
                                            @error('name')
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
                                            value="{{ $student[0]->email }}" name="email" id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Niên Khóa</label>
                                            <select class="form-control @error('batch_id') is-invalid @enderror"
                                             name="batch_id" id="batch_id">
                                                <option selected disabled>Chọn niên khóa</option>
                                                @foreach ($batches as $batch)
                                                    <option value="{{ $batch->id }}"
                                                        {{ $batch->id == $student[0]->batch_id ? 'selected':''}}>
                                                        {{ $batch->batch_name }}</option>
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
                                            <label class="form-label">Lớp</label>
                                            <select class="form-control @error('class_id') is-invalid @enderror"
                                             name="class_id" id="class_id">
                                                <option selected disabled>Chọn lớp</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $class->id == $student[0]->class_id ? 'selected':''}}>
                                                        {{ $class->class_name }}</option>
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
                                             name="gender" id="gender">
                                                <option selected disabled>Giới tính</option>
                                                <option value="1"
                                                {{ $student[0]->gender == '1' ? 'selected' : '' }}>Nam</option>
                                                <option value="2"
                                                {{ $student[0]->gender == '2' ? 'selected' : '' }}>Nữ</option>
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
                                            <label class="form-label">Ngày sinh</label>
                                            <input type="text" class="datepicker form-control
                                            @error('dateOfBirth') is-invalid @enderror"
                                            value="{{ $student[0]->dateOfBirth }}" name="dateOfBirth" id="dateOfBirth">
                                            @error('dateOfBirth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên bố</label>
                                            <input type="text" class="form-control
                                            @error('father_name') is-invalid @enderror"
                                             value="{{ $student[0]->father_name }}" name="father_name" id="father_name">
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
                                            <input type="text" class="form-control
                                            @error('father_number') is-invalid @enderror"
                                            value="{{ $student[0]->father_number }}" name="father_number" id="father_number">
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
                                            <input type="text" class="form-control
                                            @error('mother_name') is-invalid @enderror"
                                             value="{{ $student[0]->mother_name }}" name="mother_name" id="mother_name">
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
                                            <input type="text" class="form-control
                                            @error('mother_number') is-invalid @enderror"
                                            value="{{ $student[0]->mother_number }}" name="mother_number" id="mother_number">
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
                                            value="{{ $student[0]->address }}" name="address" id="address" rows="5">{{ $student[0]->address }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Ảnh</label>
                                        <img class="rounded-circle" width="35" src="{{ URL::to('/images/'. $student[0]->upload) }}" alt="{{ $student[0]->upload }}">
                                        <div class="form-group fallback w-100">
                                            <input type="hidden" name="hidden_image" value="{{ $student[0]->upload }}">
                                            <input type="file" class="dropify" name="upload" id="upload">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <button type="button" class="btn btn-light"><a href="{{ route('student/list') }}">Trở lại</a></button>
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
