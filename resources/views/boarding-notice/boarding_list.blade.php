@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
           @foreach ($data as $notification)
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 d-flex">
                                    <p class="text-danger"><strong>{{ $notification->data['title'] }}</strong>
                                    <span class="badge badge-rounded badge-danger">{{ $notification->created_at }}</span></p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                       <p>{!!  $notification->data['content'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- <script>
        CKEDITOR.replace( 'content' );
    </script> --}}
@endsection
