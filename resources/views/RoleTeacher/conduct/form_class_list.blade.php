@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách lớp chủ nhiệm</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="">Danh sách lớp chủ nhiệm</a></li>
                    </ol>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Năm học</th>
                                            <th>Chủ nhiệm lớp</th>
                                            <th>Nhập hạnh kiểm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $data )
                                        <tr>
                                            <td>{{ $data->year->session_name }}</td>
                                            <td>{{ $data->class->class_name }}</td>
                                            <td>
                                                <a href="{{ url('teacher/conduct/add/'.$data->class_id.'/'.$data->session_id) }}"
                                                    class="btn btn-sm btn-success"><i class="la la-pencil"></i></a>
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
@endsection
