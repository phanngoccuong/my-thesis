@extends('layouts.st_master')

@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Add Lesson</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lessons</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson Add</a></li>
                    </ol>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Basic Info</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('lesson/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Course</label>
                                            <select class="form-control @error('course_id') is-invalid @enderror"
                                             name="course_id" id="course_id">
                                                <option selected disabled>Select course</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
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

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Teacher</label>
                                            <select class="form-control @error('teacher_id') is-invalid @enderror"
                                             name="teacher_id" id="teacher_id">
                                                <option selected disabled>Select teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
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
                                                    <option value="{{ $classroom->id }}">{{ $classroom->classroom_name }}</option>
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
                                                    <option value="{{ $day->id }}">{{ $day->day_name }}</option>
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
                                                    <option value="{{ $time->id }}">{{ $time->time }}</option>
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
                                                    <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
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
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-light">Cancel</button>
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
