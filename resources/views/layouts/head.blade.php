<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        html {
          scroll-behavior: smooth;
        }

        body {
          font-family: 'Poppins';
        }
    </style>

    {{-- <link href="{{ asset('/datatable/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!-- End of global css content-->

    <!-- Specific css content placeholder -->
    @stack('css')

    <!-- End of specific css content placeholder -->

    <style type="text/css">
        .card-header .fa {
            transition: .3s transform ease-in-out;
        }

        .card-header .collapsed .fa {
            transform: rotate(90deg);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('custom/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('custom/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('custom/datatable/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('custom/js/scripts.bundle.js') }}"></script>

    <script src="{{ asset('custom/datatable/datatables.bundle.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/r-2.2.5/rg-1.1.2/rr-1.2.7/sp-1.1.1/sl-1.3.1/datatables.min.css" />

    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script src="{{ asset('/js/app.js') }}"></script>
</head>
