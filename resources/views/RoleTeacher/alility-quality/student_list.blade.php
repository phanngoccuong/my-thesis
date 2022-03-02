@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            {{-- <form action="{{ route('conduct.get') }}" method="GET" enctype="multipart/form-data">
                @csrf --}}
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Năm học</label>
                        <select class="form-control"
                            name="session_id" id="session_id">
                            <option value="{{ $year->id }}">{{ $year->session_name }}</option>
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
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ và tên</th>
                                            <th>Địa chỉ</th>
                                            <th>Email</th>
                                            <th>Ngày sinh</th>
                                            <th>Đánh giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $key => $student )
                                        <tr>
                                            <input type="hidden" name="student_id[]" value="{{ $student->student->id }}">
                                            <td><strong>{{ $student->student->id }}</strong></td>
                                            <td>{{ $student->student->last_name }} {{ $student->student->first_name }}</td>
                                            <td>{{ $student->student->address }}</td>
                                            <td>{{ $student->student->email }}</td>
                                            <td>{{ $student->student->dateOfBirth }}</td>
                                            <td>
                                                <a href="{{ url('teacher/ability-quality/add/'.$student->student->id.'/'.$class->id.'/'.$year->id) }}"
                                                    class="btn btn-sm btn-success"><i class="la la-pencil"></i></a>
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
