<ul class="list-unstyled components">
    @php
        $route = Route::currentRouteName();
        $settingOpen = $route == 'admin.role.index' || $route == 'admin.identifier.index' || $route == 'admin.unit.index' || $route == 'admin.user.index';
    @endphp
    <li class="{{ $route = 'home' ? 'active' : '' }}">
        <a href="{{ route('home') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    </li>

    <li class="">
        <a href="#inboxSubMenu" data-toggle="collapse" aria-expanded="false" class="d-flex">
            <div class="mr-auto"><i class="fas fa-inbox fa-fw mr-2"></i>Inbox</div>
            <div class="mr-1">
                <i class="fa fa-caret-down"></i>
            </div>
        </a>
        <ul class="collapse list-unstyled " id="inboxSubMenu">
            <li class="{{ $route == 'inbox.index' ? 'active' : '' }}">
                <a href="{{ route('inbox.index') }}" class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-user-tie fa-fw mr-2"></i>
                        Surat Masuk
                    </div>
                    @php
                        $read = \App\Models\LetterReceiver::where('user_id', Auth::user()->id)
                            ->whereHas('letterStatus', function ($query) {
                                $query->whereNot('status', "Menunggu Persetujuan");
                            })
                            ->count();
                    @endphp
                    @if($read > 0)
                        <span class="badge badge-danger d-flex align-items-center">
                            {{ $read < 10 ? $read : '9+' }}
                        </span>
                    @endif
                </a>
            </li>

            <li class="{{ $route == 'inbox.indexDisposition' ? 'active' : '' }}">
                <a href="{{ route('inbox.indexDisposition') }}">
                    <i class="fas fa-users-viewfinder fa-fw mr-2"></i>
                    Disposisi Masuk
                </a>
            </li>

            <li class="{{ $route == 'inbox.indexOutboxDisposition' ? 'active' : '' }}">
                <a href="{{ route('inbox.indexOutboxDisposition') }}">
                    <i class="fas fa-users-gear fa-fw mr-2"></i>
                    Disposisi Keluar
                </a>
            </li>

        </ul>
    </li>
    <li class="{{ $route = 'sent.letter-index' ? 'active' : '' }}">
        <a href="{{ route('sent.letter-index') }}"><i class="fas fa-envelope fa-fw mr-2"></i>Kirim Surat</a>
    </li>

    <li class="{{ $route = 'approve.letter.index' ? 'active' : '' }}">
        <a href="{{ route('approve.letter.index') }}"><i class="fas fa-envelope-open-text fa-fw mr-2"></i>Surat
            Keluar</a>
    </li>

    <li class="{{ $settingOpen ? 'active' : '' }}">
        <a href="#settingSubMenu" data-toggle="collapse" aria-expanded="false" class="d-flex">
            <div class="mr-auto"><i class="c-red-300 ti-settings mr-2"></i>Setting</div>
            <div class="mr-1">
                <i class="fa fa-caret-down"></i>
            </div>
        </a>
        <ul class="collapse list-unstyled {{ $settingOpen ? 'show' : '' }} " id="settingSubMenu">
            <li class="{{ $route == 'admin.user.index' ? 'active' : '' }}">
                {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}"> --}}
                <a href="{{ route('admin.user.index') }}">
                    <i class="fas fa-user-tie fa-fw mr-2"></i>
                    User
                </a>
            </li>

            <li class="{{ $route == 'admin.identifier.index' ? 'active' : '' }}">
                <a href="{{ route('admin.identifier.index') }}">
                    <i class="fas fa-users-gear fa-fw mr-2"></i>
                    Identifier
                </a>
            </li>

            <li class="{{ $route == 'admin.unit.index' ? 'active' : '' }}">
                <a href="{{ route('admin.unit.index') }}">
                    <i class="fas fa-users-viewfinder fa-fw mr-2"></i>
                    Unit
                </a>
            </li>

            <li class="{{ $route == 'admin.role.index' ? 'active' : '' }}">
                <a href="{{ route('admin.role.index') }}">
                    <i class="fas fa-user-lock fa-fw mr-2"></i>
                    Role
                </a>
            </li>
        </ul>
    </li>
</ul>
