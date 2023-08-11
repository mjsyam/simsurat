<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.head')

<body class="app">


    @include('layouts.partials.spinner')


    <div>
        <!-- #Left Sidebar ==================== -->
        @include('layouts.partials.sidebar')

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('layouts.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">

                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>

                        @include('layouts.partials.messages')


                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }} Designed by
                    <a>Colorlib</a>. Created By Patrick Polii All rights
                    reserved.</span>
            </footer>
        </div>
    </div>

    {{-- @yield('script')
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Global js content -->

    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @stack('js')
    <!-- End of specific js content placeholder --> --}}




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
