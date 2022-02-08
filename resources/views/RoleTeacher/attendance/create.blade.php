@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row page-titles mx-0">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Kì học</label>
                            <select class="form-control"
                                name="semester_id" id="semester_id">
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Lớp</label>
                            <select class="form-control"
                                name="class_id" id="class_id">
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Môn học</label>
                            <select class="form-control"
                                name="course_id" id="course_id">
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Ngày</label>
                            <input type="text" class="form-control datepicker
                            @error('date') is-invalid @enderror"
                            name="date" id="date">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách học sinh</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                           <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key=>$student)
                                            <tr>
                                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $student->last_name }} {{ $student->first_name }}</td>
                                                <td>{{ $student->dateOfBirth }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>
                                                    <select class="form-control @error('status') is-invalid @enderror" name="status[]">
                                                        <option>Điểm danh</option>
                                                        <option value="1">Có</option>
                                                        <option value="0">Vắng</option>
                                                        <option value="2">Nghỉ có phép</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                </table>
                                <div class="col-lg-7">
                                    <button type="submit" class="btn btn-primary">Nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>

@endsection
