@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('student.comment.get') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option selected disabled>Chọn kì</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach

                        </select>

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
