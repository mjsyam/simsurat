<ul class="list-unstyled components">
    @can('manajemen-admin')
    <li class="{{Request::is('admin/user*') ? 'active' : ''}}">
        <a href="{{url('/admin/user')}}"><i class="fas fa-users fa-fw mr-2"></i>Manajemen User</a>
    </li>
    @endcan

    @can('manajemen-dosen')
    <li class="{{Request::is('dosen') ? 'active' : ''}}">
        <a href="{{url('dosen')}}"><i class="fas fa-home fa-fw mr-2"></i>Beranda</a>
    </li>
    @endcan

    @can('manajemen-tendik')
    <li class="{{Request::is('tendik') ? 'active' : ''}}">
        <a href="{{url('tendik')}}"><i class="fas fa-home fa-fw mr-2"></i>Beranda</a>
    </li>
    @endcan

    @can('manajemen-pegawai')
    <li class="{{Request::is('pegawai/datapribadi/*') ? 'active' : ''}}">
        <a href="#datapribadiSubmenu" data-toggle="collapse" aria-expanded="false" class="d-flex">
            <div class="mr-auto"><i class="fas fa-user-tie fa-fw mr-2"></i>Profil</div>
            <div class="mr-1">
                <i class="fa fa-caret-down"></i>
            </div>
        </a>
        <ul class="collapse list-unstyled {{Request::is('pegawai/datapribadi/*') ? 'show' : ''}} " id="datapribadiSubmenu">
            <li class="{{Request::is('pegawai/datapribadi*') ? 'active' : ''}}">
                <a href="{{url('pegawai/datapribadi/profil')}}">Data Pribadi</a>
            </li>
        </ul>
    </li>

    <li class="{{Request::is('pegawai/presensi/*') ? 'active' : ''}}">
        <a href="#presensiSubMenu" data-toggle="collapse" aria-expanded="false" class="d-flex">
            <div class="mr-auto"><i class="fas fa-calendar-day fa-fw mr-2"></i>Presensi</div>
            <div class="mr-1">
                <i class="fa fa-caret-down"></i>
            </div>
        </a>
        <ul class="collapse list-unstyled {{Request::is('pegawai/presensi/*') ? 'show' : ''}} " id="presensiSubMenu">
            <li class="{{Request::is('pegawai/presensi/laporan-presensi*') ? 'active' : ''}}">
                <a href="{{url('pegawai/presensi/laporan-presensi')}}">Laporan Presensi</a>
            </li>
            @can('manajemen-pegawai')
            <li class="{{Request::is('pegawai/presensi/presensi-online*') ? 'active' : ''}}">
                <a href="{{url('pegawai/presensi/presensi-online')}}">Presensi Online</a>
            </li>
            @endcan
            {{-- <li class="{{Request::is('pegawai/absensi/dinas-luar*') ? 'active' : ''}}">
                <a href="{{url('pegawai/absensi/dinas-luar')}}">Dinas Luar</a>
            </li> --}}
            {{-- <li class="{{Request::is('pegawai/absensi/pengajuan-cuti*') ? 'active' : ''}}">
                <a href="{{url('pegawai/absensi/pengajuan-cuti')}}">Pengajuan Cuti</a>
            </li> --}}

            {{-- @can('manajemen-pimpinan')
            <li class="{{Request::is('pegawai/absensi/laporan-unit*') ? 'active' : ''}}">
                <a href="{{url('pegawai/absensi/laporan-unit')}}">Laporan Unit</a>
            </li>
            @endcan --}}
        </ul>
    </li>

</ul>
