@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách bài học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thời khóa biểu</a></li>
                        <li class="breadcrumb-item active"><a href="">Danh sách bài học</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDetailsForm">
                                +Thêm mới
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>Bài học</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $key=>$detail)
                                        <tr>
                                            <td><strong>{{ ++$key }}</strong></td>
                                            <td>{{ $detail->date }}</td>
                                            <td>{{ $detail->lesson_title }}</td>
                                            <td>
                                                <a href="{{ url('teacher/timetable-details/edit/'.$detail->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="la la-pencil"></i>Sửa</a>
                                                <a href="{{ url('teacher/timetable-details/delete/'.$detail->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:note :schoolLesson="$schoolLesson"/>
            </div>
        </div>
    </div>
{{-- Add Modal --}}

<div class="modal fade" id="addDetailsForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nhập chi tiết bài giảng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('teacher.lesson-details.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="lesson_id" value="{{ $schoolLesson->id }}">
                <div class="form-group">
                    <label for="">Ngày</label>
                    <input type="text" class="datepicker form-control"
                        name="date">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="">Chi tiết</label>
                    <input type="text" class="form-control"
                        name="lesson_title">
                        @error('lesson_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
  </div>
</div>
{{-- End modal --}}
{{-- edit modal --}}
<div class="modal fade" id="editDetailsForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết bài giảng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="lesson_id" value="{{ $schoolLesson->id }}">
                <div class="form-group">
                    <label for="">Ngày</label>
                    <input type="text" class="datepicker form-control"
                        name="date" id="date">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="">Chi tiết</label>
                    <input type="text" class="form-control"
                        name="lesson_title" id="lesson_title">
                        @error('lesson_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
