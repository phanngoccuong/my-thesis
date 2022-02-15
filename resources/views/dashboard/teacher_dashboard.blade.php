@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-xl-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ URL::to('assets/images/sli1.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ URL::to('assets/images/sli1.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ URL::to('assets/images/sli1.png') }}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3" style="max-height: 648px">
                    <div class="card">
                        <img class="img-fluid" style="max-height: 147px" src="{{ URL::to('assets/images/pic1.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Báo cáo công khai năm học 2020-2021 của trường Tiểu học Xuân Phương theo Thông tư 36/2017/TT-BGGĐT ngày 28 tháng 12 năm 2017 của Bộ trưởng Bộ Giáo dục và Đào tạo</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between">
                                    <span class="mb-0 text-muted">2022-08-25</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" style="max-height: 147px" src="{{ URL::to('assets/images/sli2.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Trường Tiểu Học Xuân Phương Trao Quà Tết Cho Những Học Sinh Có Hoàn Cảnh Khó Khăn Nhân Dịp Tết Nhâm Dần 2022</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2022-01-01</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" style="max-height: 147px" src="{{ URL::to('assets/images/sli3.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Trường Tiểu Học Xuân Phương Tổ Chức Lễ Kỷ Niệm Ngày Nhà Giáo Việt Nam 20/11 Năm Học 2021-2022 Khen Thưởng Các Thầy Cô Có Thành Tích Tốt</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2021-11-20</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" src="{{ URL::to('assets/images/sli22.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Trường Tiểu Học Xuân Phương Xây Dựng Trường Chuẩn Quốc Gia Mức Độ II, Kiểm Định Chất Lượng Giáo Dục Xanh- Sạch-Đẹp-An Toàn, Thư Viện Tiên Tiến Năm Học 2021 - 2022
                                </a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2021-09-23</span>
                                    <a href="javascript:void(0);"></a></li>
                            </ul>
                            <a href="" class="btn btn-primary">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
