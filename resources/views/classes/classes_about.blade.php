@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thông tin lớp</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý lớp</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thông tin lớp</a></li>
                    </ol>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">Danh sách lớp</a></li>
                        {{-- <li class="nav-item"><a href="{{ route('') }}"
                            class="nav-link btn-primary">Thời khóa biểu</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h4 class="card-title"><strong>Thông tin lớp {{ $classes->class_name }}
                                </strong></h4>
                                </div> --}}
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ảnh</th>
                                                    <th>Họ và tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($classStudents as $key => $classStudent )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>
                                                        <img class="rounded-circle" width="35"
                                                        src="{{ URL::to('/images/'. $classStudent->upload) }}"
                                                        alt="{{ $classStudent->upload }}">
                                                    </td>
                                                    <td>{{ $classStudent->name }}</td>
                                                    <td>{{ $classStudent->address }}</td>
                                                    <td>@if ($classStudent->gender == 1 )
                                                        Nam
                                                        @elseif ($classStudent->gender == 2 )
                                                        Nữ
                                                        @endif
                                                    </td>
                                                    <td>{{ $classStudent->dateOfBirth }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="float-right">
                                            {{ $classStudents->links('pagination::bootstrap-4') }}
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
