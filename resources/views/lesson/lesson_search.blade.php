@extends('layouts.st_master')

@section('content')
@include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách tiết học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý thời khóa biểu</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Danh sách tiết học</a></li>
                    </ol>
                </div>
            </div>


            <form action="{{ route('lesson.search') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Môn học" name="course">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Giáo viên"  name="teacher">
                        </div>
                    </div>
                     <div class="col-lg-2">
                        <div class="form-group">
                            <select name="class_id" class="form-control">
                                <option value="">Chọn lớp</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                       </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách tiết học</h4>
                            <a href="{{ route('lesson.add') }}" class="btn btn-primary">+ Thêm mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Kì học</th>
                                            <th>Môn học</th>
                                            <th>Giờ học</th>
                                            <th>Ngày</th>
                                            <th>Lớp</th>
                                            <th>Giáo viên</th>
                                            <th>Phòng học</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lessons as $key => $lesson )
                                        <tr>
                                            <td>{{ $lesson->semester_name  }}</td>
                                            <td>{{ $lesson->course_name }}</td>
                                            <td>{{ $lesson->time }}</td>
                                            <td>{{ $lesson->day_name }}</td>
                                            <td>{{ $lesson->class_name }}</td>
                                            <td>{{ $lesson->teacher_name}}</td>
                                            <td>{{ $lesson->classroom_name }}</td>
                                            <td>
                                                <a href="{{ url('admin/lesson/edit/'.$lesson->id) }}" class="btn btn-sm btn-success"><i class="la la-pencil"></i>Sửa</a>
                                                <a href="{{ url('admin/lesson/delete/'.$lesson->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {{ $lessons->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
