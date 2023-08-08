<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Office</title>

        <!-- Fonts -->
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        {{ $slot }}

        <footer>
            <section class="row row-padding text-center kontak-sukma" id="kontak">
                <div class="col-md-6 offset-md-3 head-section"> 
                    <h3>Kontak E-Office</h3>
                </div>
                <div class="col-md-4">
                   <img src="{{ asset('images/map.png') }}" alt="" style="height: 55px;">
                   <h6>Jl. Soekarno-Hatta Km.15, Karang Joang, Balikpapan, Kalimantan Timur, 76127</h6>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/telephone.png') }}" alt="" style="height: 44px;">
                    <h6>0542-8530801</h6>
                 </div>
                 <div class="col-md-4">
                    <img src="{{ asset('images/email.png') }}" alt="" style="height: 50px;">
                    <h6>humas@itk.ac.id</h6>
                 </div>
            </section>
            <section class="row-divider">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="copyright">Copyright© 2020 Institut Teknologi Kalimantan - Design: Patrick Polii</p>
                    </div>
                </div>    
            </section>
            
        </footer>
        <!-- min js -->
        <script src="{{ mix('/js/app.js') }}"></script>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- Plugins -->
        <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
        <script src="{{ asset('js/waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('js/imgfix.min.js') }}"></script>

        <!-- Global Init -->
        <script src="{{ asset('js/custom.js') }}"></script>

    </body>

</html>