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
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Môn học</th>
                                        <th scope="col">Phòng học</th>
                                        <th scope="col">Giáo viên</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Giờ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr class="text-center">
                                        <td>{{ $data->course->course_name }}</td>
                                        <td>{{ $data->room->classroom_name }}</td>
                                        <td>{{ $data->teachers->teacher_name }}</td>
                                        <td>{{ $data->day->day_name }}</td>
                                        <td>{{ $data->time->time }}</td>
                                        {{-- <td>
                                            <a href="{{ url('student/document/list/'.$data->id) }}"
                                                class="btn btn-sm btn-info"><i class="la la-bullhorn"></i></a>
                                        </td> --}}

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
