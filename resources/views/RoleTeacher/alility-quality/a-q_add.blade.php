@extends('layouts.st_master')
@section('content')
  @include('sidebar.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            <livewire:aq :student="$student" :class="$class" :year="$year"/>
        </div>
    </div>
@endsection
