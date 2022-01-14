@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Gửi tài liệu</h4>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher.document.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Lớp</label>
                                            <input type="text" class="form-control"
                                            value="{{ $lesson->classes->class_name}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Môn học</label>
                                            <input type="text" class="form-control"
                                            value="{{ $lesson->course->course_name }}" readonly>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Tiêu đề</label>
                                            <input type="text" class="form-control @error('document_name') is-invalid @enderror"
                                             value="{{ old('document_name') }}"
                                             name="document_name" id="document_name">
                                            @error('document_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Tài liệu</label>
                                            <input type="file" name="file" class="form-control" id="document-file" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
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
