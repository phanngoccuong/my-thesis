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
                        <li class="breadcrumb-item"><a href="">Học kì {{ $semesterDoc->semester_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lớp {{ $classDoc->class_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="">Môn {{ $courseDoc->course_name }}</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tài liệu</th>
                                            <th>Tải xuống</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $key=>$document)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $document->document_name }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{asset('/'.$document->document_file_path)}}"
                                                            role="button" class="btn btn-sm btn-primary"><i class="la la-cloud-download"></i></a>
                                                    </div>
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
