@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{!! Toastr::message() !!}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Classes Info</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Classes</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Class Info</a></li>
                    </ol>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                            class="nav-link btn-primary mr-1 show active">List View</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><strong>Class  Info
                                </strong></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Gender</th>
                                                    <th>Date Of Birth</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($classAllInfo as $key => $classStudent )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>
                                                        <img class="rounded-circle" width="35"
                                                        src="{{ URL::to('/images/'. $classStudent->upload) }}"
                                                        alt="{{ $classStudent->upload }}">
                                                    </td>
                                                    <td>{{ $classStudent->name }}</td>
                                                    <td>{{ $classStudent->address }}</td>
                                                    <td>@if ($classStudent->gender == 1 )
                                                        Male
                                                        @else
                                                        Female
                                                        @endif
                                                    </td>
                                                    <td>{{ $classStudent->dateOfBirth }}</td>
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
