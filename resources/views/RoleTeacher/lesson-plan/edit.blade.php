@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Kế hoạch học tập</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Học kì {{ $data->semester->semester_name }}</li>
                        <li class="breadcrumb-item active">Lớp {{ $data->classes->class_name }}</li>
                        <li class="breadcrumb-item active">Môn {{ $data->course->course_name }}</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.lesson-plan.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="semester_id" value="{{ $data->semester_id}}">
                                <input type="hidden" name="class_id" value="{{$data->class_id }}">
                                <input type="hidden" name="course_id" value="{{ $data->course_id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Ngày</label>
                                            <input type="text" class="form-control
                                            @error('date') is-invalid @enderror"
                                            value="{{ $data->date }}" name="date" id="date">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Chi tiết</label>
                                            <input type="text" class="form-control
                                            @error('title') is-invalid @enderror"
                                            value="{{ $data->title }}" name="title" id="title">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
