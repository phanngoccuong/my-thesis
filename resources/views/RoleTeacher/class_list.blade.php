@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chủ nhiệm Lớp {{ $className[0]->class_name }}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('homeTeacher') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="">Lớp {{ $className[0]->class_name }}</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                        class="nav-link btn-primary mr-1 show active">Danh sách học sinh</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h4 class="card-title">All Students List  </h4>
                                </div> --}}
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ảnh</th>
                                                    <th>Tên</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Địa chỉ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentList as $key => $student )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>
                                                        <img class="rounded-circle" width="35"
                                                        src="{{ URL::to('/images/'. $student->upload) }}"
                                                        alt="{{ $student->upload }}">
                                                    </td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>
                                                        @if ($student->gender == 1)
                                                        Nam
                                                        @elseif ($student->gender == 2)
                                                        Nữ
                                                        @endif
                                                    </td>
                                                    <td>{{ $student->dateOfBirth }}</td>
                                                    <td>{{ $student->address }}</td>
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
