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
                        <h4>Classes Info</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Class Info</a></li>
                    </ol>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title"><strong>Danh sách lớp {{ $classes->class_name }} --}}
                                </strong></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ảnh</th>
                                                    <th>Họ và tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Giới tính</th>
                                                    <th>Ngày sinh</th>
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
                                                        Male
                                                        @else
                                                        Female
                                                        @endif
                                                    </td>
                                                    <td>{{ $classStudent->dateOfBirth }}</td>
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
