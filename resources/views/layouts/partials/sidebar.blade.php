<ul class="list-unstyled components">
    @php
        $route = Route::currentRouteName();
        $settingOpen = $route == 'admin.role.index'
            || $route == 'admin.identifier.index'
            || $route == 'admin.unit.index'
            || $route == 'admin.user.index';
    @endphp

    <li class="{{ $settingOpen ? 'active' : '' }}">
        <a href="#presensiSubMenu" data-toggle="collapse" aria-expanded="false" class="d-flex">
            <div class="mr-auto"><i class="fas fa-calendar-day fa-fw mr-2"></i>Setting</div>
            <div class="mr-1">
                <i class="fa fa-caret-down"></i>
            </div>
        </a>
        <ul class="collapse list-unstyled {{ $settingOpen ? 'show' : '' }} " id="presensiSubMenu">
            <li class="{{ $route == "admin.user.index" ? 'active' : '' }}">
                {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}"> --}}
                <a href="{{ route('admin.user.index') }}">
                    <i class="c-red-300 ti-settings"></i>
                    User
                </a>
            </li>

            <li class="{{ $route == "admin.identifier.index" ? 'active' : '' }}">
                <a href="{{ route('admin.identifier.index') }}">
                    <i class="c-red-300 ti-settings"></i>
                    Identifier
                </a>
            </li>

            <li class="{{ $route == 'admin.unit.index' ? 'active' : '' }}">
                <a href="{{ route('admin.unit.index') }}">
                    <i class="c-red-300 ti-settings"></i>
                    Unit
                </a>
            </li>

            <li class="{{ $route == 'admin.role.index' ? 'active' : '' }}">
                <a href="{{ route('admin.role.index') }}">
                    <i class="c-red-300 ti-settings"></i>
                    Role
                </a>
            </li>
        </ul>
    </li>

    <li class="active">
        <a href="{{ route('sent.letter-index') }}"><i class="fas fa-home fa-fw mr-2"></i>Beranda</a>
    </li>

    <li class="{{ $route = 'inbox.index' ? 'active' : '' }}">
        <a href="{{ route('inbox.index') }}"><i class="c-red-300 ti-settings mr-2"></i>Inbox</a>
    </li>

    <li class="{{ $route = 'sent.letter-index' ? 'active' : '' }}">
        <a href="{{ route('sent.letter-index') }}"><i class="fas fa-home fa-fw mr-2"></i>Kirim Surat</a>
    </li>

    <li class="{{ $route = 'outgoing-letter.index' ? 'active' : '' }}">
        <a href="{{ route('outgoing-letter.index') }}"><i class="fas fa-home fa-fw mr-2"></i>Surat Keluar</a>
    </li>

</ul>
