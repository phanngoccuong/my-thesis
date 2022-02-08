@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách tài liệu</h4>
                    </div>
                </div>

                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Học kì {{ $semesterLess->semester_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lớp {{ $classLess->class_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="">Môn {{ $courseLess->course_name }}</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDocument">
                                +Thêm mới
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tài liệu</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $key=>$document)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $document->document_name }}</td>
                                                <td>
                                                    {{-- <div class="btn-group" role="group">
                                                        <a href="{{asset('/'.$document->document_file_path)}}"
                                                            role="button" class="btn btn-sm btn-primary"><i class="la la-cloud-download"></i></a>
                                                    </div> --}}
                                                    <a href="{{ url('teacher/document/delete/'.$document->id) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></span></a>
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

{{-- Modal --}}
<div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tải tài liệu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('teacher.document.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="semester_id" value="{{ $semesterLess->id }}">
                <input type="hidden" name="class_id" value="{{ $classLess->id }}">
                <input type="hidden" name="course_id" value="{{ $courseLess->id }}">
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
                <div class="form-group">
                    <label for="" class="form-label">Tài liệu</label>
                    <input type="file" name="file" class="form-control" id="document-file" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
  </div>
</div>
{{-- End modal --}}

@endsection
