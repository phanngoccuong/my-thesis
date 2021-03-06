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
                            <h4 style="height: 60%"><a href="">B??o c??o c??ng khai n??m h???c 2020-2021 c???a tr?????ng Ti???u h???c Xu??n Ph????ng theo Th??ng t?? 36/2017/TT-BGG??T ng??y 28 th??ng 12 n??m 2017 c???a B??? tr?????ng B??? Gi??o d???c v?? ????o t???o</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between">
                                    <span class="mb-0 text-muted">2022-08-25</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">?????c th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" style="max-height: 147px" src="{{ URL::to('assets/images/sli2.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Tr?????ng Ti???u H???c Xu??n Ph????ng Trao Qu?? T???t Cho Nh???ng H???c Sinh C?? Ho??n C???nh Kh?? Kh??n Nh??n D???p T???t Nh??m D???n 2022</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2022-01-01</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">?????c th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" style="max-height: 147px" src="{{ URL::to('assets/images/sli3.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Tr?????ng Ti???u H???c Xu??n Ph????ng T??? Ch???c L??? K??? Ni???m Ng??y Nh?? Gi??o Vi???t Nam 20/11 N??m H???c 2021-2022 Khen Th?????ng C??c Th???y C?? C?? Th??nh T??ch T???t</a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2021-11-20</span>
                                    <a href="javascript:void(0);"></a></li>

                            </ul>
                            <a href="" class="btn btn-primary">?????c th??m</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <img class="img-fluid" src="{{ URL::to('assets/images/sli22.png') }}">
                        <div class="card-body">
                            <h4 style="height: 60%"><a href="">Tr?????ng Ti???u H???c Xu??n Ph????ng X??y D???ng Tr?????ng Chu???n Qu???c Gia M???c ????? II, Ki???m ?????nh Ch???t L?????ng Gi??o D???c Xanh- S???ch-?????p-An To??n, Th?? Vi???n Ti??n Ti???n N??m H???c 2021 - 2022
                                </a></h4>
                            <ul class="list-group mb-3 list-group-flush">
                                <li class="list-group-item px-0 border-top-0 d-flex justify-content-between"><span class="mb-0 text-muted">2021-09-23</span>
                                    <a href="javascript:void(0);"></a></li>
                            </ul>
                            <a href="" class="btn btn-primary">?????c th??m</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
