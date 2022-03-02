@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Năm học</label>
                        <select class="form-control"
                            name="session_id">
                            <option value="{{ $year->id }}">{{ $year->session_name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><strong class="text-danger">Năng lực<span class="text-danger">*</span></strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Tự chủ và tự học</label>
                                    <p>{{ $data->self_management }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Giao tiếp và hợp tác</label>
                                    <p>{{ $data->cooperate }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Giải quyết vấn đề</label>
                                    <p>{{ $data->problem_solving }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><strong class="text-danger">Phẩm chất<span class="text-danger">*</span></strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Chăm học, chăm làm</label>
                                    <p>{{ $data->hard_work }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Trung thực, kỉ luật</label>
                                    <p>{{ $data->honesty }}</p>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-labe text-primary">Tự tin, trách nhiệm</label>
                                    <p>{{ $data->self_confident }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-primary">Đoàn kết , yêu thương</label>
                                    <p>{{ $data->united }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
