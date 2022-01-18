@extends('layouts.st_master')
@section('content')
@include('sidebar.sidebar')
{!! Toastr::message() !!}
<div class="content-body">
    <div class="container-fluid">
        <form action="{{ route('timetableDetails.get') }}" method="GET" enctype="multipart/form-data">
            @csrf
        <div class="row page-titles mx-0">
            <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control @error('semester_id') is-invalid @enderror"
                            name="semester_id" id="semester_id">
                            <option selected disabled>Chọn kì</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach
                        </select>
                        @error('semester_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg" style="padding-top: 30px;">
                    {{-- <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a> --}}
                     <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>

        {{-- <div class="row d-none" id="search-result">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Môn học</th>
                                        <th scope="col">Phòng học</th>
                                        <th scope="col">Giáo viên</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Giờ</th>
                                    </tr>
                                </thead>
                                <tbody id="search-tr">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        </form>
    </div>
</div>

{{-- AJAX --}}
{{-- <script type="text/javascript">
    $(document).on('click','#search',function(){
        var semester_id = $('#semester_id').val();
        $.ajax({
            url:"{{ route('timetableDetails.get') }}",
            type: "GET",
            data:{'semester_id':semester_id},
            success: function(data){
                $('#search-result').removeClass('d-none');
                var html = '';
                $.each(data,function(key,v){
                    html+=
                    '<tr>'+
                    '<td> '+v.course_name+'</td>'+
                    '<td> '+v.classroom_name+'</td>'+
                    '<td>'+v.teacher_name+'</td>'+
                    '<td>'+v.day_name+'</td>'+
                    '<td>'+v.time+'</td>'+
                    '</tr>';
                });
                html = $('#search-tr').html(html);
            }
        });
    });
</script> --}}
@endsection
