<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/rtl.css') }}" rel="stylesheet">


    <!-- Global css content -->

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

</head>
