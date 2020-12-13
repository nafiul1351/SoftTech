<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/icon/favicon.svg') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('node_modules/mdi/css/materialdesignicons.min.cs') }}s">
    <link rel="stylesheet" href="{{ asset('node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/rickshaw/rickshaw.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('bower_components/chartist/dist/chartist.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}" />
</head>
<body class="sidebar-dark">
    <!-- Contents -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('node_modules/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('node_modules/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{ asset('node_modules/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('bower_components/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('node_modules/chartist-plugin-legend/chartist-plugin-legend.js') }}"></script>
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/dashboard_1.js') }}"></script>
    <script src="{{ asset('js/bt-maxLength.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
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
    <script>
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
            var link= $(this).attr("href");
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){
                    window.location.href = link;
                }
            });
        });
    </script>
</body>
</html>