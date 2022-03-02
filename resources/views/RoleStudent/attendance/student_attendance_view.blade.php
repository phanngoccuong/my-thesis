@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('student.attendance.get') }}" method="GET" enctype="multipart/form-data">
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

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Môn học</label>
                            <select class="form-control @error('course_id') is-invalid @enderror"
                                name="course_id" id="course_id">
                                <option>Chọn môn</option>
                            </select>
                            @error('course_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2" style="padding-top: 30px;">
                       <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript">
     $(function(){
        $(document).on('change','#semester_id',function(){
            var semester_id = $('#semester_id').val();
            $.ajax({
                url:"{{ route('student.attendance.course.get') }}",
                type:"GET",
                data:{'semester_id':semester_id},
                success: function(data){
                    var html = '<option value="">Chọn môn</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.course_name+'</option>';
                    });
                    $('#course_id').html(html);
                }
            });
        });
    });
</script>

@endsection
