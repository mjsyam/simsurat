@php
    $r = \Route::current()->getAction();
    $route = isset($r['as']) ? $r['as'] : '';
@endphp

<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.dash') ? 'actived' : '' }}" href="{{ route(ADMIN . '.dash') }}"> --}}
    <a class="btn sidebar-link" href="">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="">Dashboard</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('inbox.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Inbox</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('sent.letter-index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
        </span>
        <span class="">Kirim Surat</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('outgoing-letter.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Surat Keluar</span>
    </a>
</li>
{{-- <li class="nav-item mt-3">
    <a class="btn sidebar-link" href="{{route("approve.letter.index")}}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Approve Surat</span>
    </a>
</li> --}}
<li class="nav-item mt-3">
    <a class="btn sidebar-link" href="{{ route('approve.letter.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Approve Surat</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('admin.role.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Role</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('admin.unit.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Unit</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('admin.identifier.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Pengaturan</span>
    </a>
</li>
<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.pengaturan') ? 'actived' : '' }}" href="{{ route(ADMIN . '.pengaturan.index') }}"> --}}
    <a class="btn sidebar-link" href="{{route('admin.unit.index')}}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">Unit</span>
    </a>
</li>

<li class="nav-item mt-3">
    {{-- <a class="btn sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}"> --}}
    <a class="btn sidebar-link" href="{{ route('admin.user.index') }}">
        <span class="icon-holder">
            <i class="c-red-300 ti-settings"></i>
        </span>
        <span class="">User</span>
    </a>
</li>
