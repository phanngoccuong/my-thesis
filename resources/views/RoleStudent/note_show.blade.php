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
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Giáo viên chủ nhiệm</strong></label>
                                        <input type="text" class="form-control" readonly value="{{ $teacher->teacher->teacher_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Lớp</strong></label>
                                        <input type="text" class="form-control" readonly value="{{ $class->classes->class_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Xếp loại học sinh</strong></label>
                                        @if ($data->student_type == "A")
                                            <input type="text" class="form-control" readonly value="Giỏi">
                                        @elseif ($data->student_type == "B")
                                        <input type="text" class="form-control" readonly value="Khá">
                                        @elseif ($data->student_type == "C")
                                        <input type="text" class="form-control" readonly value="Trung bình">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Xếp loại hạnh kiểm</strong></label>
                                        @if ($data->conduct == "A")
                                            <input type="text" class="form-control" readonly value="Tốt">
                                        @elseif ($data->conduct == "B")
                                        <input type="text" class="form-control" readonly value="Khá">
                                        @elseif ($data->conduct == "C")
                                        <input type="text" class="form-control" readonly value="Trung bình">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label"><strong>Nhận xét của giáo viên</strong></label>
                                        <textarea class="form-control" rows="5" readonly>{{ $data->comment }}</textarea>
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
