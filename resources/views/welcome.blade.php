<x-dashboardLayout>
    <header class="header-area header-sticky static">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo-itk" >
                            <img src="{{ asset('images/logo-itk.png') }}"  width="86px" alt="" style="margin-top: 8px;" />
                        </a>
                        @if (Route::has('login'))
                            <ul class="nav">
                                <li>
                                    <a class="js-scroll-trigger" href="#kontak" class="tentang"> <b>Kontak E-Office</b></a>
                                </li>
                                <li>
                                    @auth
                                    @switch(auth()->user()->role)
                                        @case(100)
                                            <a href="{{ route(ADMIN . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(1)
                                            <a href="{{ route(MAHASISWA . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(10)
                                            <a href="{{ route(AKADEMIK. '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(11)
                                            <a href="{{ route(JURUSAN . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(4)
                                            <a href="{{ route(UNIT . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(5)
                                            <a href="{{ route(ARSIPARIS . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(6)
                                            <a href="{{ route(SEKRETARIAT . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(7)
                                            <a href="{{ route(WAREKTOR . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>
                                            @break
                                        @case(8)
                                            <a href="{{ route(REKTOR . '.dash') }}" class="text-sm text-gray-700 underline">Home</a>.
                                            @break
                                        @default
                                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                                    @endswitch
                                    @else
                                    <a href="{{ route('login') }}" role="button" class="btn btn-outline-primary login " style="background-color:white; border-radius:8px;"><b>Login</b></a>
                                    @endif
                                </li>
                            </ul>
                        @endif
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                            <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
     <!-- ***** Header Area End ***** -->
    <header class="masthead d-flex">
        <div class="container text-center my-auto">
          <h1 class="mb-1">SELAMAT DATANG DI E-OFFICE ITK</h1>
          <a class="btn btn-primary btn-lg js-scroll-trigger" href="#tentang">Tentang E-OFFICE</a>
        </div>
        <div class="overlay"></div>   
      </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12 about text-center" id="tentang">
                <h1> Manajamen E-Office ITK</h1>
                <h4>"Merupakan sistem informasi manajemen e-office berbasis web yang berfokus pada pengelolan persuratan yang berada di lingkungan Kampus Institut Teknologi Kalimantan"</h4>   
                <div class="row-padding">
                    <a class="btn btn-primary btn-lg js-scroll-trigger" href="#services" class="btn">Lebih lanjut</a>
                </div>
            </div>
        </div>
    </div>
    <section id="services" class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title" style="color:#1b7ced">Mahasiswa</h4>
                            <div class="features-icon">
                                <i class="lni lni-brush"></i>
                            </div>
                        </div>
                        <div class="features-content">
                            <p class="text">Mahasiswa dapat membuat surat akademik dan surat terkait jurusan pada SISUKMA. Mahasiswa dapat melihat status dari pembuatan surat dan dapat mengunduh langsung surat yang telah jadi.</p>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title" style="color:#1b7ced">Internal ITK</h4>
                            <div class="features-icon">
                                <i class="lni lni-layout"></i>
                            </div>
                        </div>
                        <div class="features-content">
                            <p class="text">Internal ITK dapat membuat surat masuk dan surat keluar yang berupa tata naskah. Internal ITK dapat melihat status dari proses persetujuan surat dan dapat mengunduh langsung surat yang telah disetujui.</p>
                        </div>
                    </div> <!-- single features -->
                </div>
            </div> <!-- row -->
        </div>
    </section>
</x-dashboardLayout>