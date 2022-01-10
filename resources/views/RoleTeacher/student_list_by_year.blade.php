@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
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
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="class_id" id="class_id">
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
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Họ và tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Email</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $key => $student )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $student->student->name }}</td>
                                                    <td>{{ $student->student->address }}</td>
                                                    <td>{{ $student->student->email }}</td>
                                                    <td>{{ $student->student->dateOfBirth }}</td>
                                                    <td>
                                                        <a href="{{ url('teacher/end-semester-note/add/'.$student->student->id.'/'.$semester->semester_name) }}">
                                                        <span class="btn btn-sm btn-info"><i class="la la-plus"></i></span>
                                                        </a>
                                                        <a href="{{ url('teacher/end-semester-note/edit/'.$student->student->id.'/'.$semester->semester_name) }}">
                                                        <span class="btn btn-sm btn-success"><i class="la la-eye"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="float-right pt-2">
                                            {{ $students->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
