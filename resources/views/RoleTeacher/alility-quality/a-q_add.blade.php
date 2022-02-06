@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('a-q.store') }}" method="POST" enctype="multipart/form-data">
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
                                <option selected disabled>Chọn học kì</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                                @endforeach
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
                                        <textarea class="form-control @error('self_management') is-invalid @enderror"
                                        value="{{ old('self_management') }}" name="self_management" id="self_management" rows="3"></textarea>
                                        @error('self_management')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Giao tiếp và hợp tác</label>
                                        <textarea class="form-control @error('cooperate') is-invalid @enderror"
                                        value="{{ old('cooperate') }}" name="cooperate" id="cooperate" rows="3"></textarea>
                                        @error('cooperate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Giải quyết vấn đề</label>
                                        <textarea class="form-control @error('problem_solving') is-invalid @enderror"
                                        value="{{ old('problem_solving') }}" name="problem_solving" id="problem_solving" rows="3"></textarea>
                                        @error('problem_solving')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                        <textarea class="form-control @error('hard_work') is-invalid @enderror"
                                        value="{{ old('hard_work') }}" name="hard_work" id="hard_work" rows="3"></textarea>
                                        @error('hard_work')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Trung thực, kỉ luật</label>
                                        <textarea class="form-control @error('honesty') is-invalid @enderror"
                                        value="{{ old('honesty') }}" name="honesty" id="honesty" rows="3"></textarea>
                                        @error('honesty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Tự tin, trách nhiệm</label>
                                        <textarea class="form-control @error('self_confident') is-invalid @enderror"
                                        value="{{ old('self_confident') }}" name="self_confident" id="self_confident" rows="3"></textarea>
                                        @error('self_confident')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Đoàn kết , yêu thương</label>
                                        <textarea class="form-control @error('united') is-invalid @enderror"
                                        value="{{ old('united') }}" name="united" id="united" rows="3"></textarea>
                                        @error('united')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
