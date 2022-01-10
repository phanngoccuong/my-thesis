@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('note.student.get') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <div class="row page-titles mx-0">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Năm học</label>
                            <select class="form-control @error('session_id') is-invalid @enderror"
                                name="session_id" id="session_id">
                                <option selected disabled>Chọn năm</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->year->id }}">{{ $year->year->session_name }}</option>
                                @endforeach

                            </select>
                            @error('session_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-label">Kì học</label>
                            <select class="form-control @error('semester_id') is-invalid @enderror"
                                name="semester_id" id="semester_id">
                                <option>Chọn kì</option>
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
                            <label class="form-label">Lớp chủ nhiệm</label>
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

                    <div class="col-lg" style="padding-top: 30px;">
                        {{-- <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a> --}}
                        <button class="btn btn-primary"  type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


<script type="text/javascript">
     $(function(){
        $(document).on('change','#session_id',function(){
            var session_id = $('#session_id').val();
            $.ajax({
                url:"{{ route('note.semester.get') }}",
                type:"GET",
                data:{'session_id':session_id},
                success: function(data){
                    var html = '<option value="">Chọn kì</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.id+'">'+v.semester_name+'</option>';
                    });
                    $('#semester_id').html(html);
                }
            });
        });
    });
</script>

<script type="text/javascript">
     $(function(){
        $(document).on('change','#session_id',function(){
            var session_id = $('#session_id').val();
            $.ajax({
                url:"{{ route('note.class.get') }}",
                type:"GET",
                data:{'session_id':session_id},
                success: function(data){
                    var html = '<option value="">Chọn lớp</option>';
                    $.each(data,function(key,v){
                        html += '<option value="'+v.class_id+'">'+v.class.class_name+'</option>';
                    });
                    $('#class_id').html(html);
                }
            });
        });
    });
</script>
@endsection
