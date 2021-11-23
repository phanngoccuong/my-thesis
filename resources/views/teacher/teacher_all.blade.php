@extends('layouts.st_master')
{{-- @section('menu')
@extends('sidebar.dashboard')
@endsection --}}
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
                        <h4>All Teacher</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Teachers</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Teachers</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" style="height: 38.4px"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-file-pdf-o"></i> PDF
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('teacher/pdf-export') }}">Xuất file PDF</a>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Teachers List  </h4>
                                    <a href="{{ route('teacher/add') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Special</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teachers as $key => $teacher )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>
                                                        <img class="rounded-circle" width="35" src="{{ URL::to('/images/'. $teacher->upload) }}"
                                                        alt="{{ $teacher->upload }}">
                                                    </td>
                                                    <td>{{ $teacher->teacher_name }}</td>
                                                    <td>{{ $teacher->gender }}</td>
                                                    <td>{{ $teacher->email }}</td>
                                                    <td><a href="javascript:void(0);"><strong>{{ $teacher->mobileNumber }}</strong></a></td>
                                                    <td>{{ $teacher->dateOfBirth }}</td>
                                                    <td>{{ $teacher->special }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/teacher/edit/'.$teacher->id) }}"
                                                            class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/teacher/delete/'.$teacher->id) }}"
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
