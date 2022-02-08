@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('a-q.get') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <div class="row page-titles mx-0">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Năm học</label>
                            <select class="form-control"
                                name="session_id" id="session_id">
                                <option value="{{ $year->id }}">{{ $year->session_name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Lớp</label>
                            <select class="form-control"
                                name="class_id" id="class_id">
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Học sinh</label>
                            <select class="form-control"
                                name="semester_id">
                                <option selected disabled>{{ $student->last_name }} {{ $student->first_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Chọn học kì<span class="text-danger">*</span></label>
                            <select class="form-control"
                                name="semester_id">
                                <option selected disabled>Chọn học kì</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $student->id }}" name="student_id">
                    <div class="col-lg-2" style="padding-top: 30px;">
                        <button class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
