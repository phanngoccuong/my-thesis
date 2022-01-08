@extends('layouts.st_master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách giáo viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý giáo viên</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Danh sách giáo viên</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        {{-- <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li> --}}
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" style="height: 38.4px"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-file-pdf-o"></i> PDF
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('teacher/pdf-export') }}">Xuất file PDF</a>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách giáo viên</h4>
                                    <a href="{{ route('teacher/add') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    {{-- <th>Ảnh</th> --}}
                                                    <th>Họ và tên</th>
                                                    <th>Giới tính</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Chuyên môn</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teachers as $key => $teacher )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    {{-- <td>
                                                        <img class="rounded-circle" width="35" src="{{ URL::to('/images/'. $teacher->upload) }}"
                                                        alt="{{ $teacher->upload }}">
                                                    </td> --}}
                                                    <td>{{ $teacher->teacher_name }}</td>
                                                    <td>
                                                        @if ($teacher->gender == 1)
                                                        Nam
                                                            @elseif($teacher->gender == 2)
                                                        Nữ
                                                        @endif
                                                    </td>
                                                    <td>{{ $teacher->email }}</td>
                                                    <td><strong>{{ $teacher->mobileNumber }}</strong></td>
                                                    <td>{{ $teacher->dateOfBirth }}</td>
                                                    <td>{{ $teacher->special }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/teacher/edit/'.$teacher->id) }}"
                                                            class="btn btn-sm btn-success"><i class="la la-pencil"></i>Sửa</a>
                                                        <a href="{{ url('admin/teacher/delete/'.$teacher->id) }}"
                                                            onclick="return confirm('Are you sure to want to delete it?')">
                                                        <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="float-right">
                                            {{ $teachers->links('pagination::bootstrap-4') }}
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
