 @extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Kế hoạch học tập</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Học kì {{ $semesterPlan->semester_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lớp {{ $classPlan->class_name }}</a></li>
                        <li class="breadcrumb-item active"><a href="">Môn {{ $coursePlan->course_name }}</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>Bài học</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $key=>$detail)
                                        <tr>
                                            <td><strong>{{ ++$key }}</strong></td>
                                            <td>{{ $detail->date }}</td>
                                            <td>{{ $detail->title }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="max-height: 160px">
                        <div class="card-body">
                            @foreach ($notes as $note)
                                <textarea class="form-control" rows="4" readonly>{{  $note->note }}</textarea>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
