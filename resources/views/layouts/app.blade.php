<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.head')

<body>
    <div>
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

                        @yield('content')

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

        <!-- #Left Sidebar ==================== -->
        @include('layouts.partials.sidebar')

    </div>

    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Global js content -->

    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @stack('js')
    <!-- End of specific js content placeholder --> --}}

</body>

</html>