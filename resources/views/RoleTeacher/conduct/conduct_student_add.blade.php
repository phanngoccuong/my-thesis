@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <form action="{{ route('conduct.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Chọn học kì<span class="text-danger">*</span></label>
                        <select class="form-control"
                            name="semester_id">
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach
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
                                                    <th>ID</th>
                                                    <th>Họ và tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Email</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Nhập hạnh kiểm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $key => $student )
                                                <tr>
                                                    <input type="hidden" name="student_id[]" value="{{ $student->student->id }}">
                                                    <td><strong>{{ $student->student->id }}</strong></td>
                                                    <td>{{ $student->student->name }}</td>
                                                    <td>{{ $student->student->address }}</td>
                                                    <td>{{ $student->student->email }}</td>
                                                    <td>{{ $student->student->dateOfBirth }}</td>
                                                    <td>
                                                        <select class="form-control" name="conduct_type[]">
                                                            <option selected disabled>Chọn</option>
                                                            <option value="A">Tốt</option>
                                                            <option value="B">Khá</option>
                                                            <option value="C">Trung bình</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-lg-7">
                                            <button type="submit" class="btn btn-primary">Nhập</button>
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
