@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    {!! Toastr::message() !!}
    <div class="content-body">
        <div class="container-fluid">
             <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Năm học</th>
                                                    <th>Chủ nhiệm lớp</th>
                                                    <th>Nhập hạnh kiểm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $key => $data )
                                                <tr>
                                                   <td>{{ $data->year->session_name }}</td>
                                                   <td>{{ $data->class->class_name }}</td>
                                                   <td>
                                                        <a href="{{ url('teacher/conduct/add/'.$data->class_id.'/'.$data->session_id) }}"
                                                            class="btn btn-sm btn-success"><i class="la la-pencil"></i></a>
                                                   </td>
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


{{-- <script type="text/javascript">
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
</script> --}}
@endsection
