<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>

    @include('layout.head')

    <!-- Tiny Mce Editor -->
    {{-- <script src="https://cdn.tiny.cloud/1/4kfn1cci4s4exjeyxol6qmsh7tredakipbmk0aeqluxv1z4x/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script> --}}
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="p-b-13">
                    <img src="{{url('/asset/login/images/itk.png')}}" alt="itk" class="center">
                </div>
                <h6 style="font-weight:700;font-size:14px" align="center">Sistem Informasi</h6>
                <h4 class="font-poppins head-sidebar" align="center" style="color:#0067B2">Kepegawaian ITK</h4>
            </div>
            @include('layout.sidebar_menu')
            
        </nav>
        <!-- Page Content  -->
        <div id="content">

            <!-- Navbar  -->
            <nav class="navbar sticky-top navbar-expand-md navbar-light card">
                <div class="container-fluid" style="padding:0px">
                    <span type="button" id="sidebarCollapse" class="btn text-white" style="background-color:#0067b3">
                        <i class="fas fa-align-left"></i>
                    </span>
                    
                    {{-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> --}}
                    {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto"> --}}
                            {{-- <div class="top-right links d-inline">
                                <div class="top-text">
                                    <a style="font-weight:500">{{ Auth::user()->nip }}</a>, <a href="{{url('logout')}}" class="logout"> Logout</a>
                                </div>
                            </div> --}}

                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle bg-white" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;">
                                    <img 
                                        @if(Auth::user()->roles()->first()->name == 'Admin')
                                        src="{{ Avatar::create('Super Admin')->toBase64() }}"
                                        @elseif(Auth::user()->roles()->first()->name == 'Kepegawaian')
                                        src="{{ Avatar::create('Admin Kepegawaian')->toBase64() }}"
                                        @else
                                        src="{{ Avatar::create(Auth::user()->profil->nama_pegawai)->toBase64() }}"
                                        @endif
                                    width="35"/>
                                </button>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="width:250px;font-size:13px">
                                    <div class="row pl-3 pr-3 pt-2 pb-1">
                                        <div class="col-2 mr-3 align-self-center">
                                            <img 
                                                @if(Auth::user()->roles()->first()->name == 'Admin')
                                                src="{{ Avatar::create('Super Admin')->toBase64() }}"
                                                @elseif(Auth::user()->roles()->first()->name == 'Kepegawaian')
                                                src="{{ Avatar::create('Admin Kepegawaian')->toBase64() }}"
                                                @else
                                                src="{{ Avatar::create(Auth::user()->profil->nama_pegawai)->toBase64() }}"
                                                @endif                                            
                                            width="40"/>
                                        </div>
                                        <div class="col align-self-center">
                                            <div class="custom-scroll" style="height:20px;overflow-y:hidden">
                                                <p class="font-weight-bold mb-0">
                                                    @if(Auth::user()->roles()->first()->name == 'Admin')
                                                    Super Admin
                                                    @elseif(Auth::user()->roles()->first()->name == 'Kepegawaian')
                                                    Admin Kepegawaian
                                                    @else
                                                    {{ Auth::user()->profil->nama_pegawai }}
                                                    @endif
                                                </p>
                                            </div>
                                            <a>{{ Auth::user()->nip }}</a>
                                        </div>
                                    </div>
                                    <hr width="85%">
                                    
                                    <div class="row pt-0 pb-1">
                                        <div class="col">
                                            <a class="dropdown-item" href="{{ url('setting') }}"><i class="fas fa-cog fa-fw mr-2"></i>Pengaturan</a>
                                            <a class="dropdown-item" href="{{url('logout')}}" style="color:#FF5722"><i class="fas fa-sign-out-alt fa-fw mr-2"></i>Keluar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </ul>
                    </div> --}}
                </div>
            </nav>

            @yield('content')

        </div>

        @yield('modal')

        <!-- Dark Overlay element -->
        <div class="overlay"></div>   
    </div>
            <button class="btn btn-primary" id="btnTop">
                <i class="fas fa-arrow-circle-up"></i>
            </button>

    @include('layout.script')

    @stack('javascript')

</body>


</html>