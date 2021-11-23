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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thông tin học sinh</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-statistics">
                            <div class="text-center container-fluid">
                                <div class="profile-photo">
                                    <img class="img-fluid rounded-circle" width="200"
                                    src="{{ URL::to('/images/'. $studentInfo[0]->upload) }}"">
                                </div>
                                <h3 class="item-title pt-1">{{ $studentInfo[0]->name }}</h3>
                                    <p>Trường tiểu học Xuân Phương</p>
                            </div>
                            <div class="text-center mt-4 border-bottom-1 pb-3">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="m-b-0">Lớp</h3><span>{{ $studentInfo[0]->classes->class_name }}</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-b-0">Khóa</h3><span>{{ $studentInfo[0]->batches->batch_name }}</span>
                                    </div>
                                </div>
                                {{-- <div class="mt-4">
                                    <a href="javascript:void()" class="btn btn-primary px-5 mr-3 mb-4">Follow</a>
                                    <a href="javascript:void()" class="btn btn-dark px-3 mb-4">Send Message</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="pt-1">
                                <div class="settings-form">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" value="{{ $studentInfo[0]->email }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Ngày sinh</label>
                                                <input type="text" value="{{ $studentInfo[0]->dateOfBirth }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control"
                                            value="{{ $studentInfo[0]->address }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Giới tính</label>
                                            <input type="text" class="form-control"
                                            @if ($studentInfo[0]->gender == 1)
                                                value="Nam"
                                            @elseif ($studentInfo[0]->gender == 2)
                                                 value="Nữ"
                                            @endif
                                            >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Họ và tên bố</label>
                                            <input type="text" value="{{ $studentInfo[0]->father_name }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Số điện thoại bố</label>
                                            <input type="text" value="{{ $studentInfo[0]->father_number }}"
                                                class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Họ và tên mẹ</label>
                                            <input type="text" value="{{ $studentInfo[0]->mother_name }}"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Số điện thoại mẹ</label>
                                            <input type="text" value="{{ $studentInfo[0]->mother_number }}"
                                                class="form-control" readonly>
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
</div>

@endsection
