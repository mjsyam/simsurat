<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.head')
@yield('css')

<body>
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="mb-5">
                    <img src="{{url('/images/Lambang_ITK.png')}}" alt="itk" class="center">
                </div>
                <h6 style="font-weight:700;font-size:14px; text-align: center">Sistem Informasi</h6>
                <h4 class="font-poppins head-sidebar" style="color:#0067B2; text-align: center">Surat ITK</h4>
            </div>
            @include('layouts.partials.sidebar')
        </nav>
        <!-- Page Content  -->
        <div id="content" style="background-color: whitesmoke; margin: 0 !important; padding: 0 !important">

            <!-- Navbar  -->
            @include('layouts.partials.topbar')
            <div class="card" style="margin:30px; padding: 30px;">
                <div class="card-body">
                @yield('content')
                </div>
            </div>

        </div>

        @yield('modal')

        <!-- Dark Overlay element -->
        <div class="overlay"></div>
    </div>
            <button class="btn btn-primary" id="btnTop">
                <i class="fas fa-arrow-circle-up"></i>
            </button>

    @stack('js')
    @yield('script')

</body>
</html>
