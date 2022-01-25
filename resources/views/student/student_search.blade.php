@extends('layouts.st_master')
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
                        <h4>Danh sách học sinh</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý học sinh</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student.list') }}">Danh sách học sinh</a></li>
                    </ol>
                </div>
            </div>
            {{-- search form --}}
            <form action="{{ route('student.search') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Họ và tên" name="name">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email"  name="email">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            {{-- //end form --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách học sinh</h4>
                                    <a href="{{ route('student.add') }}" class="btn btn-primary">+ Thêm mới</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Họ và tên</th>
                                                    <th>Email</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Khóa</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentShow as $key => $student )
                                                <tr>
                                                    <td><strong>{{ $student->id }}</strong></td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>{{ $student->batches->batch_name }}</td>
                                                    <td>{{ $student->dateOfBirth }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/student/edit/'.$student->id) }}"
                                                            class="btn btn-sm btn-success"><i class="la la-pencil"></i>Sửa</a>
                                                        <a href="{{ url('admin/student/delete/'.$student->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="float-right pt-2">
                                            {{ $studentShow->links('pagination::bootstrap-4') }}
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
