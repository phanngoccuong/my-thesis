@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
             <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Năm học</th>
                                                    <th>Chủ nhiệm lớp</th>
                                                    <th>Ghi sổ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $key => $data )
                                                <tr>
                                                   <td>{{ $data->year->session_name }}</td>
                                                   <td>{{ $data->class->class_name }}</td>
                                                   <td>
                                                        <a href="{{ url('teacher/ability-quality/list/'.$data->class_id.'/'.$data->session_id) }}"
                                                            class="btn btn-sm btn-success"><i class="la la-pencil"></i></a>
                                                   </td>
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
