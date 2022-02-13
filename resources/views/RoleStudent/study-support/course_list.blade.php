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
                        <select class="form-control @error('semester_id') is-invalid @enderror"
                            name="semester_id" id="semester_id">
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
                                        <th>Giáo viên</th>
                                        <th>Kế hoạch học tập</th>
                                        <th>Tài liệu học tập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key=>$data)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $data->course->course_name }}</td>
                                        <td>{{ $data->teachers->teacher_name }}</td>
                                        <td>
                                            <a href="{{ url('student/studySupport/plan/'.$semester->id.'/'.$class->class_id.'/'.$data->course_id) }}"
                                                class="btn btn-sm btn-success"><i class="la la-eye"></i></a>
                                        </td>
                                        <td>
                                             <a href="{{ url('student/studySupport/document/'.$semester->id.'/'.$class->class_id.'/'.$data->course_id) }}"
                                                class="btn btn-sm btn-primary"><i class="la la-arrow-circle-o-down"></i></a>
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
