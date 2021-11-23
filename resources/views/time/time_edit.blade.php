@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Edit Time</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Time</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Time Edit</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Display edit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('time/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $times[0]->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Time</label>
                                            <input type="text" class="form-control
                                            @error('time') is-invalid @enderror"
                                            value="{{ $times[0]->time }}" name="time" id="time">
                                            @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-light"><a href="{{ route('time/list') }}">Back</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
