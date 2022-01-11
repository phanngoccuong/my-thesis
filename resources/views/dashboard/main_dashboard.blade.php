@extends('layouts.st_master')
@section('content')
    <!-- Sidebar start -->
    @include('sidebar.sidebar')
    <!-- Sidebar end -->

    <!-- Content body start -->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    <div class="widget-stat bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Tài khoản</p>
                                    <h3 class="text-white">{{ $users }}</h3>
                                    <div class="progress mb-2 bg-white">
                                        <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="widget-stat bg-warning">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-user"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Học sinh</p>
                                    <h3 class="text-white">{{ $students }}</h3>
                                    <div class="progress mb-2 bg-white">
                                        <div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="widget-stat bg-secondary">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-graduation-cap"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Giáo viên</p>
                                    <h3 class="text-white">{{ $teachers }}</h3>
                                    <div class="progress mb-2 bg-white">
                                        <div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="widget-stat bg-danger">
                        <div class="card-body">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="la la-dollar"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Năm học</p>
                                    <h3 class="text-white">{{ $year_session->session_name }}</h3>
                                    <div class="progress mb-2 bg-white">
                                        <div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
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
