<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{env('APP_NAME')}}</title>
        
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/sticky-footer-navbar.css')}}" rel="stylesheet" />
        <link href="{{asset('css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css/select2-bootstrap-5-theme.min.css')}}" rel="stylesheet" />
        <style>
        </style>
    </head>
    <body class="d-flex flex-column h-100">
        @yield('header')
        @yield('content')
        <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
        <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('js/jquery.form.js')}}"></script>
        <script src="{{asset('js/select2.min.js')}}"></script>
        <script src="{{asset('js/ckeditor.js')}}"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        
        @yield('script')
        
        @yield('footer')
    </body>
</html>
