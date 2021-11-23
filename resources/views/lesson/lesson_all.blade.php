@extends('layouts.st_master')

@section('content')
@include('sidebar.sidebar')

    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>All Lesson</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lessons</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Lessons</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Lesson List  </h4>
                                    <a href="{{ route('lesson/add') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Semester</th>
                                                    <th>Course</th>
                                                    <th>Time</th>
                                                    <th>Day</th>
                                                    <th>Class</th>
                                                    <th>Teacher</th>
                                                    <th>Room</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lessons as $key => $lesson )
                                                <tr>
                                                    <td>{{ $lesson->semester_name  }}</td>
                                                    <td>{{ $lesson->course_name }}</td>
                                                    <td>{{ $lesson->time }}</td>
                                                    <td>{{ $lesson->day_name }}</td>
                                                    <td>{{ $lesson->class_name }}</td>
                                                    <td>{{ $lesson->teacher_name}}</td>
                                                    <td>{{ $lesson->classroom_name }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/lesson/edit/'.$lesson->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/lesson/delete/'.$lesson->id) }}"
                                                            onclick="return confirm('Are you sure to want to delete it?')">
                                                        <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></span></a>
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
