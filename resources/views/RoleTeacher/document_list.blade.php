@extends('layouts.st_master')
@section('content')
    @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Danh sách tài liệu</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tài liệu</th>
                                                    <th>Tải xuống</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documents as $key=>$document)
                                                    <tr>
                                                        <td>{{ $document->document_name }}</td>
                                                        <td>
                                                             <div class="btn-group" role="group">
                                                                <a href="{{asset('/'.$document->document_file_path)}}" role="button" class="btn btn-sm btn-primary"><i class="la la-cloud-download"></i></a>
                                                            </div>
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

@endsection
