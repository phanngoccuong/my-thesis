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
                        <h4>Danh sách kì học</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý học kì</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Danh sách học kì</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Danh sách kì học</h4>
                            <a href="{{ route('semester.add') }}" class="btn btn-primary">+ Thêm mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kì học</th>
                                            <th>Bắt đầu</th>
                                            <th>Kết thúc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semesters as $key => $semester )
                                        <tr>
                                            <td><strong>{{ ++$key }}</strong></td>
                                            <td>{{ $semester->semester_name }}</td>
                                            <td>{{ $semester->start_date }}</td>
                                            <td>{{  $semester->end_date}}</td>
                                            <td>
                                                <a href="{{ url('admin/semester/edit/'.$semester->id) }}"
                                                        class="btn btn-sm btn-success"><i class="la la-pencil"></i>Sửa</a>
                                                <a href="{{ url('admin/semester/delete/'.$semester->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {{ $semesters->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
