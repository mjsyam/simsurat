<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
</head>
