@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
    {!! Toastr::message() !!}
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
                <form action="{{ route('promotion.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                {{-- <tr>
                                    <input type="hidden" value="{{ $data->student->id }}" name="student_id[]">
                                    <input type="hidden" name="session_id" value="{{ $latestYearId }}">
                                    <td>{{ $data->student->id  }}</td>
                                    <td>{{ $data->student->name }}</td>
                                    <td>{{ $data->student->dateOfBirth }}</td>
                                    <td>{{ $data->classes->class_name }}</td>
                                    <td>{{ $data->year->session_name }}</td>

                                    <td>
                                        <select class="form-control @error('class_id') is-invalid @enderror"
                                        name="class_id[]" id="class_id">
                                            <option selected disabled>Chọn lớp</option>
                                            @foreach ($newClass as $key=>$value)
                                                <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr> --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="col-lg-7">
                        <button type="submit" class="btn btn-primary">Thực hiện</button>
                    </div> --}}
                </div>
             </form>
            </div>
        </div>
    </div>
@endsection
