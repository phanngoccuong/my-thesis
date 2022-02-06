@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách lớp</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý lớp</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Danh sách lớp</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">Khối 1</a></li>
                        <li class="nav-item"><a href="#group2" data-toggle="tab" class="nav-link btn-primary  mr-1">Khối 2</a></li>
                        <li class="nav-item"><a href="#group3" data-toggle="tab" class="nav-link btn-primary  mr-1">Khối 3</a></li>
                        <li class="nav-item"><a href="#group4" data-toggle="tab" class="nav-link btn-primary  mr-1">Khối 4</a></li>
                        <li class="nav-item"><a href="#group5" data-toggle="tab" class="nav-link btn-primary  mr-1">Khối 5</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="row">
                                @foreach ($class1s as $class )
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">
                                                            Sửa</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            >Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-lg-center">
                                                <div class="mx-auto mb-1 w-50 rounded-circle"
                                                style="height: 120px;background-color: rgb(255,143,22)">
                                                </div>
                                                <div style="height: 50px;margin-top: -100px;font-size:50px;color: #fff ">
                                                    {{ $class->class_name }}
                                                </div>

                                                <div style="margin-top: 60px">
                                                    <a class="btn btn-outline-primary btn-rounded px-4"
                                                    href="{{ url('admin/classes/show/'.$class->id) }}">Xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="group2" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($class2s as $class )
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">
                                                            Sửa</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            >Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-lg-center">
                                                <div class="mx-auto mb-1 w-50 rounded-circle"
                                                style="height: 120px;background-color: rgb(255,143,22)">
                                                </div>
                                                <div style="height: 50px;margin-top: -100px;font-size:50px;color: #fff ">
                                                    {{ $class->class_name }}
                                                </div>
                                                <div style="margin-top: 60px">
                                                    <a class="btn btn-outline-primary btn-rounded px-4"
                                                    href="{{ url('admin/classes/show/'.$class->id) }}">Xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="group3" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($class3s as $class )
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">
                                                            Sửa</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            >Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-lg-center">
                                                <div class="mx-auto mb-1 w-50 rounded-circle"
                                                style="height: 120px;background-color: rgb(255,143,22)">
                                                </div>
                                                <div style="height: 50px;margin-top: -100px;font-size:50px;color: #fff ">
                                                    {{ $class->class_name }}
                                                </div>
                                                <div style="margin-top: 60px">
                                                    <a class="btn btn-outline-primary btn-rounded px-4"
                                                    href="{{ url('admin/classes/show/'.$class->id) }}">Xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="group4" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($class4s as $class )
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">
                                                            Sửa</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            >Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-lg-center">
                                                <div class="mx-auto mb-1 w-50 rounded-circle"
                                                style="height: 120px;background-color: rgb(255,143,22)">
                                                </div>
                                                <div style="height: 50px;margin-top: -100px;font-size:50px;color: #fff ">
                                                    {{ $class->class_name }}
                                                </div>
                                                <div style="margin-top: 60px">
                                                    <a class="btn btn-outline-primary btn-rounded px-4"
                                                    href="{{ url('admin/classes/show/'.$class->id) }}">Xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="group5" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($class5s as $class )
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">
                                                            Sửa</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            >Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-lg-center">
                                                <div class="mx-auto mb-1 w-50 rounded-circle"
                                                style="height: 120px;background-color: rgb(255,143,22)">
                                                </div>
                                                <div style="height: 50px;margin-top: -100px;font-size:50px;color: #fff ">
                                                    {{ $class->class_name }}
                                                </div>
                                                <div style="margin-top: 60px">
                                                    <a class="btn btn-outline-primary btn-rounded px-4"
                                                    href="{{ url('admin/classes/show/'.$class->id) }}">Xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

