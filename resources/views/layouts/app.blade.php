<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.head')
@yield('css')

<body>
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                {{-- <div class="p-b-13">
                    <img src="{{url('/asset/login/images/itk.png')}}" alt="itk" class="center">
                </div> --}}
                <h6 style="font-weight:700;font-size:14px" align="center">Sistem Informasi</h6>
                <h4 class="font-poppins head-sidebar" align="center" style="color:#0067B2">Kepegawaian ITK</h4>
            </div>
            @include('layouts.partials.sidebar')
        </nav>
        <!-- Page Content  -->
        <div id="content" style="background-color: whitesmoke">

            <!-- Navbar  -->
            @include('layouts.partials.topbar')

            @yield('content')

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
