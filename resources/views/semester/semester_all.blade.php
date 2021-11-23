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
                        <h4>All Semesters</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Semesters</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Semesters</a></li>
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
                                    <h4 class="card-title">All Semester List  </h4>
                                    <a href="{{ route('semester/add') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Semester</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($semesters as $key => $semester )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $semester->semester_name }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/semester/edit/'.$semester->id) }}"
                                                             class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/semester/delete/'.$semester->id) }}"
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

                        {{-- <div id="grid-view" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($classShow as $class )
                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="card card-profile">
                                        <div class="card-header justify-content-end pb-0">
                                            <div class="dropdown">
                                                <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                    <span class="dropdown-dots fs--1"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="py-2">
                                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2">
                                            <div class="text-center">
                                                <div class="profile-photo">
                                                    <img class="rounded-circle" width="35" src="{{ URL::to('/images/'. $student->upload) }}" alt="{{ $student->upload }}">
                                                </div>
                                                <h3 class="mt-4 mb-1">{{ $student->name }}</h3>
                                                <p class="text-muted">{{ $student->email }}</p>
                                                <ul class="list-group mb-3 list-group-flush">
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span>Roll No.</span><strong>{{ $student->rollNo }}</strong></li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Phone No. :</span><strong>{{ $student->mobileNumber }}</strong></li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Admission Date. :</span><strong>{{ $student->registrationDate }}</strong></li>
                                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                                        <span class="mb-0">Email:</span><strong>{{ $student->email }}</strong></li>
                                                </ul>
                                                <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{ route('student/about') }}">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
