@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Môn học</th>
                                                    <th>Điểm giữa kì</th>
                                                    <th>Điểm cuối kì</th>
                                                    <th>Tổng kết</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key=>$value)
                                                    @php
                                                        $final = ($value->half_mark + $value->final_mark) /2;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $value->course->course_name }}</td>
                                                        @if ($value->is_point == 1)
                                                        <td>{{ $value->half_mark }}</td>
                                                        <td>{{ $value->final_mark }}</td>
                                                        <td>{{ $final }}</td>
                                                        @elseif ($value->is_point == 0)
                                                        <td>
                                                            <i class="la la-close"></i>
                                                        </td>
                                                        <td> <i class="la la-close"></i></td>

                                                        @if ($value->result == 1)
                                                        <td><span class="badge bg-warning">
                                                            Đạt</span></td>
                                                        @elseif ($value->result == 2)
                                                         <td><span class="badge bg-success">
                                                            Hoàn thành tốt</span></td>
                                                        @elseif ($value->result == 0)
                                                            <td><span class="badge bg-danger">
                                                            Không đạt</span></td>
                                                        @endif
                                                        @endif
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
