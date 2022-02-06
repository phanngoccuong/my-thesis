@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('comment.update') }}" method="POST" enctype="multipart/form-data">
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
                                            <table class="table header-border table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Họ và tên</th>

                                                        <th>Email</th>
                                                        <th>Nhận xét</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $student)
                                                        <tr>
                                                            <input type="hidden" name="student_id[]" value="{{ $student->student_id }}">
                                                            <td>{{ $student->student_id }}</td>
                                                            <td>{{ $student->student->last_name }} {{ $student->student->first_name }}</td>

                                                            <td>{{ $student->student->email }}</td>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                name="comment[]" value="{{ $student->comment  }}">
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
            </div>
        </form>
    </div>
@endsection
