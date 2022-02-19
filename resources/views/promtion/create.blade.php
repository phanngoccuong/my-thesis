@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')

    @if($previousYear)
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Học sinh lên lớp</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>Lớp năm trước</th>
                                <th>Năm học trước</th>
                                <th>Năm học mới</th>
                                <th>Lên lớp</th>
                            </tr>
                        </thead>

                         <tbody>
                            @foreach ($datas as $key => $data )
                             <livewire:promo :latestYear="$latestYear" :data="$data" :newClass="$newClass"/>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </form>
            </div>
        </div>
    </div>
    @else
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h3 class="text-danger">Chưa tạo năm học mới</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
