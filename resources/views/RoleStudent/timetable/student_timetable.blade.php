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
                        <h4>Thời khóa biểu kì {{ $class->semester_name }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered verticle-middle table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Thời gian</th>
                                            @foreach ($days as $day)
                                            <th class="text-center">{{ $day->day_name }}</th>
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
@endsection

