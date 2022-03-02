@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Thông tin học sinh</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thông tin học sinh</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="pt-1">
                                <div class="settings-form">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>Họ và tên</strong></label>
                                            <input type="email" value="{{ $student->last_name }} {{ $student->first_name }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>Niên khóa</strong></label>
                                                <input type="text" value="{{ $student->batches->batch_name  }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>Email</strong></label>
                                            <input type="email" value="{{ $student->email }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>Ngày sinh</strong></label>
                                                <input type="text" value="{{ $student->dateOfBirth }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>Địa chỉ</strong></label>
                                            <input type="text" class="form-control"
                                            value="{{ $student->address }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label><strong>Giới tính</strong></label>
                                            <input type="text" class="form-control"
                                            @if ($student->gender == 1)
                                                value="Nam"
                                            @elseif ($student->gender == 2)
                                                 value="Nữ"
                                            @endif
                                            >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>Họ và tên bố</strong></label>
                                            <input type="text" value="{{ $student->father_name }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>Số điện thoại bố</strong></label>
                                            <input type="text" value="{{ $student->father_number }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>Họ và tên mẹ</strong></label>
                                            <input type="text" value="{{ $student->mother_name }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>Số điện thoại mẹ</strong></label>
                                            <input type="text" value="{{ $student->mother_number }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             {{-- <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Thành tích<span class="text-danger">*</span></strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="table-responsive">
                                       <table class="table table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>Học kì</th>
                                                    <th>Lớp</th>
                                                    <th>Thành tích</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rewards as $key => $reward )
                                                <tr>
                                                    <td>{{ $reward->semester->semester_name }}</td>
                                                    <td>{{ $reward->classes->class_name }}</td>
                                                    <td>{{ $reward->student_reward }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div> --}}

        </div>
    </div>
</div>
@endsection
