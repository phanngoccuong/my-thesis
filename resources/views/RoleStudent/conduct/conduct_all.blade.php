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
                        <h4>Hạnh kiểm học sinh</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Lớp</th>
                                                    <th>Học kì</th>
                                                    <th>Hạnh kiểm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $value )
                                                <tr>
                                                    <td><strong>{{ ++$key }}</strong></td>
                                                    <td>{{ $value->classes->class_name }}</td>
                                                    <td>{{ $value->semester->semester_name }}</td>
                                                        @if ($value->conduct_type == "A")
                                                        <td><span class="badge bg-success">
                                                            Tốt</span></td>
                                                        @elseif ($value->conduct_type == "B")
                                                         <td><span class="badge bg-warning">
                                                            Khá</span></td>
                                                        @elseif ($value->conduct_type == "C")
                                                        <td><span class="badge bg-danger">
                                                            Trung bình</span></td>
                                                        @endif

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
