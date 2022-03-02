@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('student.a-q.get') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Năm học</label>
                        <select class="form-control @error('session_id') is-invalid @enderror"
                            name="session_id">
                            <option selected disabled>Chọn năm</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->session_name }}</option>
                            @endforeach
                        </select>
                        @error('session_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg" style="padding-top: 30px;">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
