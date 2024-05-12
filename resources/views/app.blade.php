<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Laravel Exam</title>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Toastify CSS -->
    <link href="{{asset('/css/toastify.min.css')}}" rel="stylesheet">

    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>

     <!-- SweetAlert2 JS-->
     <script src="{{asset('/js/sweetalert2.min.js')}}"></script>

    <!-- Toastify JS-->
    <script src="{{asset('/js/toastify.min.js')}}"></script>

    <!-- jQuery library -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>

     <!-- Moment JS-->
     <script src="{{asset('/js/moment.min.js')}}"></script>
</head>
<body>
    <main>
        @yield('content')
        
        <script src="{{asset('/js/app.js')}}"></script>
    </main>
</body>
</html>