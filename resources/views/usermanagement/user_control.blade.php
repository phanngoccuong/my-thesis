@extends('layouts.st_master')
@section('content')
   @include('sidebar.sidebar')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Quản lý người dùng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="userManagement">Quản lý người dùng</a></li>
                    </ol>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ và tên</th>
                                            <th>Ảnh</th>
                                            <th>Email</th>
                                            <th>Vai trò</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td class="id">{{ ++$key }}</td>
                                                <td class="name">{{ $item->name }}</td>
                                                <td class="name">
                                                    <div class="avatar avatar-xl">
                                                        <img class="rounded-circle" width="35"
                                                       src="{{ URL::to('/images/'. $item->avatar) }}"
                                                        alt="{{ $item->avatar }}">
                                                    </div>
                                                </td>
                                                <td class="email">{{ $item->email }}</td>

                                                @if($item->role_name =='Admin')
                                                <td class="role_name"><span  class="badge bg-success">{{ $item->role_name }}</span></td>
                                                @endif
                                                @if($item->role_name =='Student')
                                                <td class="role_name"><span  class="badge bg-info">{{ $item->role_name }}</span></td>
                                                @endif
                                                @if($item->role_name =='Teacher')
                                                <td class="role_name"><span  class=" badge bg-warning">{{ $item->role_name }}</span></td>
                                                @endif
                                                <td class="text-center">
                                                    {{-- <a href="{{ route('user.add') }}">
                                                        <span class="btn btn-sm btn-info"><i class="la la-plus"></i></span>
                                                    </a> --}}
                                                    <a href="{{ url('admin/view/detail/'.$item->id) }}">
                                                        <span class="btn btn-sm btn-primary"><i class="la la-pencil"></i></span>
                                                    </a>
                                                    <a href="{{ url('admin/delete_user/'.$item->id) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right pt-2">
                                    {{ $data->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
