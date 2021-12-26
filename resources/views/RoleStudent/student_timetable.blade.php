@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {{-- <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thời khóa biểu</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="">Thời khóa biểu</a></li>
                    </ol>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered verticle-middle table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>Thời gian</th>
                                                    @foreach ($days as $day)
                                                    <th>{{ $day->day_name }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($timetableData as $time => $days)
                                                <tr>
                                                    <td>{{ $time }}</td>
                                                    @foreach($days as $value)
                                                        {{-- @if (is_array($value)) --}}
                                                            <td class="align-middle text-center">
                                                                {{ $value['course_name'] }}
                                                            </td>
                                                    @endforeach
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

