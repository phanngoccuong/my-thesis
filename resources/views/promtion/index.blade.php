@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{{-- message --}}
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('promotion.create') }}" method="GET" enctype="multipart/form-data">
            @csrf
                <div class="row page-titles mx-0">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Lớp</label>
                            <select class="form-control"
                                name="class_id" id="class_id">
                                    <option selected disabled>Chọn lớp</option>
                                    @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2" style="padding-top: 30px;">
                       <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
