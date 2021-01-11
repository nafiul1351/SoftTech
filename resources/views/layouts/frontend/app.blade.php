<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/icon/favicon.svg') }}">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('public/frontend/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('public/frontend/css/slick-theme.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('public/frontend/css/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}" />
</head>

<body>
    <!-- Contents -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{asset('public/js/toastr.min.js')}}"></script>
    @yield('scripts')
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                break;
            }
        @endif
    </script>
</body>

</html>