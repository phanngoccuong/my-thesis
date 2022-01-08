@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
            <form action="{{ route('student.mark.get') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="row page-titles mx-0">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label">Kì học</label>
                        <select class="form-control"
                            name="semester_id" id="semester_id">
                            <option selected disabled>Chọn kì</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach

                        </select>

                    </div>
                </div>
                <div class="col-lg" style="padding-top: 30px;">
                    {{-- <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a> --}}
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    {{-- AJAX --}}
{{-- <script type="text/javascript">
    $(document).on('click','#search',function(){
        var semester_id = $('#semester_id').val();
        $.ajax({
            url:"{{ route('student.mark.get') }}",
            type: "GET",
            data:{'semester_id':semester_id},
            success: function(data){
                $('#search-mark-result').removeClass('d-none');
                var html = '';
                $.each(data,function(key,v){
                    html+=
                    '<tr>'+
                    '<td> '+(key+1)+'</td>'+
                    '<td> '+v.course.course_name+'</td>'+
                    '<td>'+v.half_mark+'</td>'+
                    '<td>'+v.final_mark+'</td>'+
                    '</tr>';
                });
                html = $('#search-tr').html(html);
            }
        });
    });
</script> --}}
@endsection
