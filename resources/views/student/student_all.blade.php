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
                        <h4>All Student</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Student</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Students List  </h4>
                                    <a href="{{ route('student/add') }}" class="btn btn-primary">+ Add new</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Class</th>
                                                    <th>Address</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($studentShow as $key => $student )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>
                                                        <img class="rounded-circle" width="35"
                                                        src="{{ URL::to('/images/'. $student->upload) }}" alt="{{ $student->upload }}">
                                                    </td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->class_name }}</td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>{{ $student->dateOfBirth }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/student/edit/'.$student->id) }}"
                                                            class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                        <a href="{{ url('admin/student/delete/'.$student->id) }}"
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
