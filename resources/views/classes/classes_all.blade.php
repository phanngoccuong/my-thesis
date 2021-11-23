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
                        <h4>All Classes</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Classes</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Classes</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">

                            {{--  --}}
                             <div class="row">
                                @foreach ($classShow as $class )
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
                                                            href="{{ url('admin/classes/edit/'.$class->id) }}">Edit</a>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ url('admin/classes/delete/'.$class->id) }}">Delete</a>
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
                                                <ul class="list-group pt-5 mb-3 list-group-flush">
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">
                                                            Chủ nhiệm:</span>
                                                            <strong>{{ $class->formTeacher['teacher_name'] }}
                                                            </strong></li>
                                                </ul>
                                                <a class="btn btn-outline-primary btn-rounded px-4"
                                                href="{{ url('admin/classes/show/'.$class->id) }}">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                         <div id="grid-view" class="tab-pane fade col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Classes List  </h4>
                                    <a href="{{ route('classes/add') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($classShow as $key => $class )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $class->class_name }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/classes/show/'.$class->id) }}"
                                                            class="btn btn-sm btn-success"><i class="la la-play"></i></a>
                                                        <a href="{{ url('admin/classes/edit/'.$class->id) }}"
                                                            class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/classes/delete/'.$class->id) }}"
                                                            onclick="return confirm('Are you sure to want to delete it?')">
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
        </div>
    </div>
@endsection

