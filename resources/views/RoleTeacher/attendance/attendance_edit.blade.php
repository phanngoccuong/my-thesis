@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('attendance.get') }}" method="GET" enctype="multipart/form-data">
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
                            <label class="form-label">Lớp</label>
                            <select class="form-control @error('class_id') is-invalid @enderror"
                                name="class_id" id="class_id">
                                <option>Chọn lớp</option>

                            </select>
                            @error('class_id')
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

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Ngày</label>
                            <select class="form-control @error('date') is-invalid @enderror"
                                name="date" id="date">
                                <option>Chọn ngày</option>
                            </select>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    {{-- <div class="col-lg" style="padding-top: 30px;">
                        <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a>
                    </div> --}}
                    <div class="col-lg" style="padding-top: 30px;">
                       <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- AJAX --}}
{{-- <script type="text/javascript">
    $(document).on('click','#search',function(){
        var class_id = $('#class_id').val();
        var course_id = $('#course_id').val();
        var semester_id = $('#semester_id').val();
        $.ajax({
            url:"{{ route('attendance.edit.list') }}",
            type: "GET",
            data:{'class_id':class_id,'course_id':course_id},
            success: function(data){
                $('#search-result').removeClass('d-none');
                var html = '';
                $.each(data,function(key,v){
                    html+=
                    '<tr>'+
                    '<td> '+(key+1)+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                    '<td>'+v.student.name+'</td>'+
                    '<td>'+v.student.dateOfBirth+'</td>'+
                    '<td>'+v.student.email+'</td>'+
                    '<td>'+v.student.address+'</td>'+

                    '</tr>';
                });
                html = $('#search-tr').html(html);
            }
        });
    });
</script> --}}

<script type="text/javascript">
     $(function(){
        $(document).on('change','#semester_id',function(){
            var semester_id = $('#semester_id').val();
            $.ajax({
                url:"{{ route('mark.get.class') }}",
                type:"GET",
                data:{'semester_id':semester_id},
                success: function(data){
                    var html = '<option value="">Chọn lớp</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.class_name+'</option>';
                    });
                    $('#class_id').html(html);
                }
            });
        });
    });
</script>

<script type="text/javascript">
     $(function(){
        $(document).on('change','#class_id',function(){
            var class_id = $('#class_id').val();
            $.ajax({
                url:"{{ route('mark.get.course') }}",
                type:"GET",
                data:{'class_id':class_id},
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

<script type="text/javascript">
     $(function(){
        $(document).on('change','#course_id',function(){
            var course_id = $('#course_id').val();
            var class_id = $('#class_id').val();
            var semester_id = $('#semester_id').val();
            $.ajax({
                url:"{{ route('date.get') }}",
                type:"GET",
                data:{'course_id':course_id,'class_id':class_id,'semester_id':semester_id},
                success: function(data){
                    var html = '<option value="">Chọn ngày</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.date+'">'+v.date+'</option>';
                    });
                    $('#date').html(html);
                }
            });
        });
    });
</script>


@endsection
