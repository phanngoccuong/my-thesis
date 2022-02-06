@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('teacher.assign.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row page-titles mx-0">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Năm học</label>
                            <select class="form-control @error('session_id') is-invalid @enderror"
                                name="session_id" id="session_id">
                                <option selected disabled>Chọn năm</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->session_name }}</option>
                                @endforeach

                            </select>
                            @error('session_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                                                <th>Lớp</th>
                                                <th>Chủ nhiệm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $key=>$class)
                                                <tr>
                                                    <input type="hidden" name="class_id[]" value="{{ $class->id }}">
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $class->class_name }}</td>
                                                    <td>
                                                        <select class="form-control @error('teacher_id') is-invalid @enderror"
                                                         name="teacher_id[]">
                                                            <option selected disabled>Chọn giáo viên</option>
                                                            @foreach ($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('teacher_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
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
                <div class="col-lg-12" style="margin-bottom: 20px">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
@endsection

