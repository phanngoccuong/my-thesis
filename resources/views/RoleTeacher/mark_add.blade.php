@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('mark.search.list') }}" method="GET" enctype="multipart/form-data">
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
                                {{-- @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">
                                        {{ $class->class_name }}</option>
                                @endforeach --}}
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
                            <label class="form-label">Điểm</label>
                            <select class="form-control @error('type_id') is-invalid @enderror"
                                name="type_id" id="type_id">
                                <option>Chọn loại điểm</option>
                                <option value="1">Giữa kỳ</option>
                                <option value="2">Cuối kỳ</option>
                            </select>
                            @error('type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg" style="padding-top: 30px;">
                        <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a>
                    </div>
                </div>

                <div class="row d-none" id="search-result">
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">All Students List  </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody id="search-tr">

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
        </form>
    </div>

    {{-- AJAX --}}
<script type="text/javascript">
    $(document).on('click','#search',function(){
        var class_id = $('#class_id').val();
        $.ajax({
            url:"{{ route('mark.search.list') }}",
            type: "GET",
            data:{'class_id':class_id},
            success: function(data){
                $('#search-result').removeClass('d-none');
                var html = '';
                $.each(data,function(key,v){
                    html+=
                    '<tr>'+
                    '<td>'+v.name+'</td>'+
                    '<td>'+v.email+'</td>'+
                    '</tr>';
                });
                html = $('#search-tr').html(html);
            }
        });
    });
</script>

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
                    var html = '<option value="">Chọn môn học</option>';
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
