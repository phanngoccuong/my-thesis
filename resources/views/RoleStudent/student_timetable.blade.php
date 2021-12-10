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
                        <h4>Timetable</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Timetable</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display" id="example3" style="min-width: 845px">
                                            <thead>
                                                <th>Time</th>
                                                @foreach ($days as $day)
                                                   <th>{{ $day->day_name }}</th>
                                                @endforeach
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>7h20-8h05</td>
                                                     @foreach ($shift1s as $shift1)
                                                    <td>{{ $shift1->course_name }}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>8h15-9h00</td>
                                                     @foreach ($shift2s as $shift2)
                                                    <td>{{ $shift2->course_name }}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                     <td>9h20-10h05</td>
                                                     @foreach ($shift3s as $shift3)
                                                    <td>{{ $shift2->course_name }}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>10h15-11h00</td>
                                                     @foreach ($shift4s as $shift4)
                                                    <td>{{ $shift2->course_name }}</td>
                                                    @endforeach
                                                </tr>
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

