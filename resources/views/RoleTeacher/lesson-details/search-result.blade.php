@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{!! Toastr::message() !!}
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id">
                            <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
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
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Môn học</th>
                                        <th>Lớp</th>
                                        <th>Kế hoạch học tập</th>
                                        <th>Tài liệu môn học</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key=>$data)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $data->course->course_name }}</td>
                                        <td>{{ $data->classes->class_name }}</td>
                                        <td>
                                            <a href="{{ url('teacher/timetable-plan/index/'.$semester->id.'/'.$data->class_id.'/'.$data->course_id) }}"
                                                class="btn btn-sm btn-success"><i class="la la-plus"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ url('teacher/document/upload/'.$data->id) }}"
                                                class="btn btn-sm btn-success"><i class="la la-cloud-upload"></i></a>
                                            <a href="{{ url('teacher/document/list/'.$semester->id.'/'.$data->class_id.'/'.$data->course_id) }}"
                                                class="btn btn-sm btn-info"><i class="la la-bullhorn"></i></a>
                                        </td>
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
