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
                        <h4>Danh sách khen thưởng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý khen thưởng</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Danh sách khen thưởng</a></li>
                    </ol>
                </div>
            </div>
            <form action="{{ route('reward.search') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                           <select name="semester_id" class="form-control">
                               <option value="">Chọn học kì</option>
                               @foreach ($semesters as $semester)
                                   <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Danh sách khen thưởng</h4>
                                    <div class="d-flex">
                                        <div class="dropdown">
                                            <button class="btn btn-danger dropdown-toggle" type="button" style="height: 38.4px"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-file-pdf-o"></i> PDF
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('reward.pdf-export') }}">Xuất file PDF</a>
                                            </div>
                                        </div>
                                        <div class="dropdown" style="background-color: #1A7343">
                                            <button class="btn dropdown-toggle text-light" type="button" style="height: 38.4px"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-file-excel-o"></i> Excel
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('teacher.excel.export') }}">Xuất file Excel</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter">
                                                      Nhập file Excel
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Họ và tên</th>
                                                    <th>Lớp</th>
                                                    <th>Học kì</th>
                                                    <th>Hình thức khen thưởng</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rewards as $key=>$reward )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $reward->student->name }}</td>
                                                    <td>{{ $reward->classes->class_name }}</td>
                                                    <td>{{ $reward->semester->semester_name }}</td>
                                                    <td>{{ $reward->student_reward }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/reward/delete/'.$reward->id) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <span class="btn btn-sm btn-danger"><i class="la la-trash-o"></i>Xóa</span></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="float-right">
                                            {{ $rewards->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nhập file Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('reward.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="file">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
       </form>
    </div>
  </div>
</div>
@endsection
