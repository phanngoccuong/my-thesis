@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{!! Toastr::message() !!}
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Danh sách lớp giảng dạy</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">Danh sách học sinh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classShow as $key => $class)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            {{ $class->class_name }}
                                        </td>
                                        <td>
                                            <a href="{{ url('teacher/all-class/about/'.$class->id) }}"
                                            class="btn btn-sm btn-primary"><i class="la la-list"></i></a>
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
