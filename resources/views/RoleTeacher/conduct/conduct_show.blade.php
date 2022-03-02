@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('conduct.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row page-titles mx-0">
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
                        <label class="form-label">Học kì<span class="text-danger">*</span></label>
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
                                            <input type="hidden" name="student_id[]" value="{{ $student->student_id }}">
                                            <td><strong>{{ $student->student_id }}</strong></td>
                                            <td>{{ $student->student->last_name }} {{ $student->student->first_name }}</td>
                                            <td>{{ $student->student->address }}</td>
                                            <td>{{ $student->student->email }}</td>
                                            <td>{{ $student->student->dateOfBirth }}</td>
                                            <td>
                                                <select class="form-control" name="conduct_type[]">
                                                    <option selected disabled>Chọn</option>
                                                    <option value="A" {{ $student->conduct_type == "A" ? 'selected':'' }}>Tốt</option>
                                                    <option value="B" {{ $student->conduct_type == "B" ? 'selected':'' }}>Khá</option>
                                                    <option value="C" {{ $student->conduct_type == "C" ? 'selected':'' }}>Trung bình</option>
                                                </select>
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
            </form>
        </div>
    </div>
@endsection
