@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
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
                    <a id="search" class="btn btn-primary" name="search">Tìm kiếm</a>
                </div>
            </div>

            <div class="row d-none" id="search-mark-result">
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
                                                    <th>Môn học</th>
                                                    <th>Điểm giữa kì</th>
                                                    <th>Điểm cuối kì</th>
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
    </div>

    {{-- AJAX --}}
<script type="text/javascript">
    $(document).on('click','#search',function(){
        var course_id = $('#course_id').val();
        var semester_id = $('#semester_id').val();
        var type_id = $('#type_id').val();
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
</script>



@endsection
