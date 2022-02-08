@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <form action="{{ route('attendance.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row page-titles mx-0">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Lớp</label>
                        <select class="form-control"
                            name="class_id" id="class_id">
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Môn học</label>
                        <select class="form-control"
                            name="course_id" id="course_id">
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Ngày</label>
                        <select class="form-control"
                            name="date" id="date">
                            <option>{{ $date }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $data )
                                        <tr>
                                            <td><strong>{{ ++$key }}</strong></td>
                                            <input type="hidden" name="student_id[]" value="{{ $data->student_id }}">
                                            <td>{{ $data->student->last_name }} {{ $data->student->first_name }}</td>
                                            <td>{{ $data->student->dateOfBirth }}</td>
                                            <td>{{ $data->student->email }}</td>
                                            <td>{{ $data->student->address }}</td>
                                            <td>
                                                <select class="form-control @error('status') is-invalid @enderror" name="status[]">
                                                    <option>Điểm danh</option>
                                                    <option value="1"  {{ $data->status == 1 ? 'selected' : "" }}>Có</option>
                                                    <option value="0" {{ $data->status == 0 ? 'selected' : "" }}>Vắng</option>
                                                    <option value="2" {{ $data->status == 2 ? 'selected' : "" }}>Nghỉ có phép</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-lg-7">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
