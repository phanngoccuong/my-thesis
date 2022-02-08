@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chỉnh sửa tiết học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý thời khóa biểu</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Chỉnh sửa tiết học</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('lesson.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lesson->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Môn học</label>
                                            <select class="form-control @error('course_id') is-invalid @enderror"
                                                name="course_id" id="course_id">
                                                <option selected disabled>Chọn môn</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ $course->id == $lesson->course_id ? 'selected':'' }}>
                                                        {{ $course->course_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('course_id')
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
                                                        {{ $class->id == $lesson->class_id ? 'selected':''}}>
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
                                            <label class="form-label">Giáo viên</label>
                                            <select class="form-control @error('teacher_id') is-invalid @enderror"
                                             name="teacher_id" id="teacher_id">
                                                <option selected disabled>Chọn giáo viên</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ $teacher->id == $lesson->teacher_id ? 'selected':''}}>
                                                        {{ $teacher->teacher_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('teacher_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Phòng học</label>
                                            <select class="form-control @error('classroom_id') is-invalid @enderror"
                                             name="classroom_id" id="classroom_id">
                                                <option selected disabled>Chọn phòng</option>
                                                @foreach ($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}"
                                                        {{ $classroom->id == $lesson->classroom_id ? 'selected':''}}>
                                                        {{ $classroom->classroom_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('classroom_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày</label>
                                            <select class="form-control @error('day_id') is-invalid @enderror"
                                             name="day_id" id="day_id">
                                                <option selected disabled>Chọn ngày</option>
                                                @foreach ($days as $day)
                                                    <option value="{{ $day->id }}"
                                                        {{ $day->id == $lesson->day_id ? 'selected':''}}>
                                                        {{ $day->day_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('day_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Giờ học</label>
                                            <select class="form-control @error('time_id') is-invalid @enderror"
                                             name="time_id" id="time_id">
                                                <option selected disabled>Chọn giờ</option>
                                                @foreach ($times as $time)
                                                    <option value="{{ $time->id }}"
                                                        {{ $time->id == $lesson->time_id ? 'selected':''}}>
                                                        {{ $time->time }}</option>
                                                @endforeach

                                            </select>
                                            @error('time_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Kì học</label>
                                            <select class="form-control @error('semester_id') is-invalid @enderror"
                                             name="semester_id" id="semester_id">
                                                <option selected disabled>Chọn kì</option>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}"
                                                        {{ $semester->id == $lesson->semester_id ? 'selected':''}}>
                                                        {{ $semester->semester_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('semester_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        <button type="button" class="btn btn-light"><a href="{{ route('lesson.list') }}">Trở lại</a></button>
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
