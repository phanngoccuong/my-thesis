@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option selected disabled>{{ $datas[0]->semester->semester_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Lớp</label>
                        <select class="form-control"
                            name="class_id" id="class_id">
                            <option  selected disabled>{{ $datas[0]->classes->class_name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Môn học</label>
                        <select class="form-control"
                            name="course_id" id="course_id">
                            <option  selected disabled>{{ $datas[0]->course->course_name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label">Ngày</label>
                        <select class="form-control"
                            name="date" id="date">
                            <option  selected disabled>{{ $datas[0]->date }}</option>
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
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Họ và tên</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Email</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $key => $data )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $data->student->name }}</td>
                                                    <td>{{ $data->student->dateOfBirth }}</td>
                                                    <td>{{ $data->student->email }}</td>
                                                    <td>{{ $data->student->address }}</td>
                                                    @if ($data->status == 0)
                                                           <td><span class="badge bg-danger">
                                                               Vắng</span></td>
                                                    @endif
                                                    @if ($data->status == 1)
                                                           <td><span class="badge bg-success">
                                                                Có</span></td>
                                                    @endif
                                                    @if ($data->status == 2)
                                                           <td><span class="badge bg-warning">
                                                               Nghỉ có phép</span></td>
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
