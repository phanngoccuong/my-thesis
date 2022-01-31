<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('assets/images/logo.png')}}">
    <link href="{{URL::to('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::to('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    {{-- message toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
 <livewire:styles />
</head>

<body class="h-100">
     <livewire:scripts />
     @yield('content')


    <!-- Required vendors -->
    <script src="{{URL::to('assets/vendor/global/global.min.js')}}"></script>
    <script src="{{URL::to('assets/js/custom.min.js')}}"></script>
    <script src="{{URL::to('assets/js/dlabnav-init.js')}}"></script>

</body>
</html>
