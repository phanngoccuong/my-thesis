@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
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
                        <label class="form-label">Chọn học kì<span class="text-danger">*</span></label>
                        <select class="form-control"
                            name="semester_id">
                            <option selected disabled>{{ $semester->semester_name }}</option>

                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Học sinh</label>
                        <select class="form-control"
                            name="semester_id">
                            <option selected disabled>{{ $student->last_name }} {{ $student->first_name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            @if($data)
            <input type="hidden" value="{{ $student->id }}" name="student_id">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><strong>Năng lực<span class="text-danger">*</span></strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Tự chủ và tự học</label>
                                    <textarea class="form-control"
                                        name="self_management" rows="3" readonly>{{ $data->self_management }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Giao tiếp và hợp tác</label>
                                    <textarea class="form-control"
                                    name="cooperate" rows="3" readonly>{{ $data->cooperate }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Giải quyết vấn đề</label>
                                    <textarea class="form-control"
                                    name="problem_solving" rows="3" readonly>{{ $data->problem_solving }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><strong>Phẩm chất<span class="text-danger">*</span></strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Chăm học, chăm làm</label>
                                    <textarea class="form-control"
                                    name="hard_work" rows="3" readonly>{{ $data->hard_work }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Trung thực, kỉ luật</label>
                                    <textarea class="form-control"
                                    name="honesty" rows="3" readonly>{{ $data->honesty }}</textarea>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Tự tin, trách nhiệm</label>
                                    <textarea class="form-control"
                                    name="self_confident" readonly rows="3">{{ $data->self_confident }}</textarea>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Đoàn kết , yêu thương</label>
                                    <textarea class="form-control"
                                    name="united" readonly rows="3">{{ $data->united }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h3 class="text-danger">Chưa đánh giá năng lực phẩm chất cho học sinh</h3>
                    </div>
                </div>
            </div>

    </div>
        @endif
    </div>
@endsection
