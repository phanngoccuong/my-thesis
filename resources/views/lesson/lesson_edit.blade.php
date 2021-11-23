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
                        <h4>Edit Lesson</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lessons</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson Edit</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Display edit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lesson/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $lesson[0]->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Course</label>
                                            <select class="form-control @error('course_id') is-invalid @enderror"
                                                name="course_id" id="course_id">
                                                <option selected disabled>Select course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{ $course->id == $lesson[0]->course_id ? 'selected':'' }}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <select class="form-control @error('class_id') is-invalid @enderror"
                                             name="class_id" id="class_id">
                                                <option selected disabled>Select class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $class->id == $lesson[0]->class_id ? 'selected':''}}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Teacher</label>
                                            <select class="form-control @error('teacher_id') is-invalid @enderror"
                                             name="teacher_id" id="teacher_id">
                                                <option selected disabled>Select teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}"
                                                        {{ $teacher->id == $lesson[0]->teacher_id ? 'selected':''}}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Room</label>
                                            <select class="form-control @error('classroom_id') is-invalid @enderror"
                                             name="classroom_id" id="classroom_id">
                                                <option selected disabled>Select room</option>
                                                @foreach ($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}"
                                                        {{ $classroom->id == $lesson[0]->classroom_id ? 'selected':''}}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Day</label>
                                            <select class="form-control @error('day_id') is-invalid @enderror"
                                             name="day_id" id="day_id">
                                                <option selected disabled>Select day</option>
                                                @foreach ($days as $day)
                                                    <option value="{{ $day->id }}"
                                                        {{ $day->id == $lesson[0]->day_id ? 'selected':''}}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Time</label>
                                            <select class="form-control @error('time_id') is-invalid @enderror"
                                             name="time_id" id="time_id">
                                                <option selected disabled>Select time</option>
                                                @foreach ($times as $time)
                                                    <option value="{{ $time->id }}"
                                                        {{ $time->id == $lesson[0]->time_id ? 'selected':''}}>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Semester</label>
                                            <select class="form-control @error('semester_id') is-invalid @enderror"
                                             name="semester_id" id="semester_id">
                                                <option selected disabled>Select semester</option>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}"
                                                        {{ $semester->id == $lesson[0]->semester_id ? 'selected':''}}>
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

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-light"><a href="{{ route('lesson/list') }}">Back</a></button>
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
