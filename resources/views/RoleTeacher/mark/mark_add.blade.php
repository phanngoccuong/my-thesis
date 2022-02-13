@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('mark.save') }}" method="POST" enctype="multipart/form-data">
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
                </div>
                <input type="hidden" name="is_point" value="{{ $course->is_point }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Danh sách học sinh</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                             <table class="table table-hover table-responsive-sm">
                                                @if ($course->is_point == 1)
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Họ và tên</th>
                                                        <th>Ngày sinh</th>
                                                        <th>Email</th>
                                                        <th>Điểm giữa kì</th>
                                                        <th>Điểm cuối kì</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $student)
                                                        <tr>
                                                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                            <td>{{ $student->id }}</td>
                                                            <td>{{ $student->last_name }} {{ $student->first_name }}</td>
                                                            <td>{{ $student->dateOfBirth }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="half_mark[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="final_mark[]">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                @elseif ($course->is_point == 0)
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Họ và tên</th>
                                                        <th>Ngày sinh</th>
                                                        <th>Email</th>
                                                        <th>Kết quả</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $student)
                                                        <tr>
                                                             <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                            <td>{{ $student->id }}</td>
                                                            <td>{{ $student->last_name }} {{ $student->first_name }}</td>
                                                            <td>{{ $student->dateOfBirth }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>
                                                                <select class="form-control" name="result[]">
                                                                    <option selected disabled>Chọn</option>
                                                                    <option value="2">Hoàn thành tốt</option>
                                                                    <option value="1">Hoàn thành</option>
                                                                    <option value="0">Không hoàn thành</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                @endif
                                            </table>
                                            <div class="col-lg-7">
                                                <button type="submit" class="btn btn-primary">Nhập điểm</button>
                                            </div>
                                        </div>
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
