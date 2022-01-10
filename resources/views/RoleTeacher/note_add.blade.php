@extends('layouts.st_master')

@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Sổ liên lạc học sinh</h4>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('note.student.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control"
                                            value="{{ $student->name  }}"  id="name" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control"
                                            value="{{ $student->email }}" name="email" id="email" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Kì học</label>
                                            <select class="form-control"
                                             name="semester_id" id="semester_id">
                                                <option value="{{ $semesters->id }}">{{ $semesters->semester_name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Xếp loại học sinh<span class="text-danger">*</span></label>
                                            <select class="form-control @error('student_type') is-invalid @enderror"
                                             name="student_type" id="student_type">
                                                <option selected disabled>Chọn</option>
                                                <option value="A">Học sinh giỏi</option>
                                                <option value="B">Học sinh khá</option>
                                                <option value="C">Học sinh trung bình</option>
                                            </select>
                                            @error('student_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Xếp loại hạnh kiểm<span class="text-danger">*</span></label>
                                            <select class="form-control @error('conduct') is-invalid @enderror"
                                             name="conduct" id="conduct">
                                                <option selected disabled>Chọn</option>
                                                <option value="A">Tốt</option>
                                                <option value="B">Khá</option>
                                                <option value="C">Trung bình</option>
                                            </select>
                                            @error('conduct')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Nhận xét của giáo viên
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('comment') is-invalid @enderror"
                                            value="{{ old('comment') }}" name="comment" id="comment" rows="5"></textarea>
                                            @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                        <button type="submit" class="btn btn-light">Hủy</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

