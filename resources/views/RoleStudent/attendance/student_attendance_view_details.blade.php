@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option selected disabled>{{ $semester->semester_name }}</option>
                        </select>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Môn học</label>
                        <select class="form-control"
                            name="course_id" id="course_id">
                            <option selected disabled>{{ $course->course_name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $data )
                                        <tr>
                                            <td><strong>{{ ++$key }}</strong></td>
                                            <td>{{ $data->date }}</td>
                                            @if ($data->status == 0)
                                                    <td><span class="badge bg-danger">
                                                        Vắng</span></td>
                                            @endif
                                            @if ($data->status == 1)
                                                    <td><span class="badge bg-success">
                                                        Có mặt</span></td>
                                            @endif
                                            @if ($data->status == 2)
                                                    <td><span class="badge bg-warning">
                                                        Nghỉ có phép</span></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
