<div class="sidebar">
  <div class="sidebar-inner">
    <!-- ### $Sidebar Header ### -->
    <div class="sidebar-logo">
      <div class="peers ai-c fxw-nw">
        <div class="peer peer-greed">
          <a class='sidebar-link td-n' href="/">
            <div class="peers ai-c fxw-nw">
              <div class="peer">
                <div class="logo">
                  <img src="{{ asset('Logo.png') }}" style="border-radius: 50%;height: 4rem;width: 7.5rem;object-fit: contain;" alt="">
                </div>
              </div>
              <div class="peer peer-greed">
                <h5 class="lh-1 mB-0 logo-text">SISUKMA</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="peer">
          <div class="mobile-toggle sidebar-toggle">
            <a href="" class="td-n">
              <i class="ti-arrow-circle-left"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ### $Sidebar Menu ### -->
    <ul class="sidebar-menu scrollable pos-r">
      {{-- all --}}
      <li class="nav-item mT-30">
          <a class="sidebar-link">
              <span class="icon-holder">
                  <i class="c-blue-500 ti-home"></i>
              </span>
              <span class="title">Dashboard</span>
          </a>
      </li>

      {{--  --}}

      {{-- admin --}}
      <li class="nav-item">
          <a class="sidebar-link">
              <span class="icon-holder">
                  <i class="c-brown-500 ti-user"></i>
              </span>
              <span class="title">Users</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-300 ti-settings"></i>
              </span>
              <span class="title">Pengaturan</span>
          </a>
      </li>

      {{-- akademik --}}
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-purple-500 ti-write"></i>
            </span>
          <span class="title">Surat</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link">Pengajuan</a>
            <a class="sidebar-link ">Terverifikasi</a>
            <a class="sidebar-link">Diteruskan</a>
            <a class="sidebar-link ">Ditolak</a>
            <a class="sidebar-link ">Cetak</a>
            <a class="sidebar-link ">Menunggu Persetujuan</a>
            <a class="sidebar-link ">Disetujui</a>
            <a class="sidebar-link ">Selesai</a>
          </li>               
        </ul>
      </li>

      {{-- arsiparis --}}
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-green-500 ti-email"></i>
              </span>
              <span class="title">Surat Masuk</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-500 ti-files"></i>
              </span>
              <span class="title">Surat Keluar</span>
          </a>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-purple-500 ti-book"></i>
            </span>
          <span class="title">Buku Agenda</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Surat Masuk</a>
            <a class="sidebar-link ">Surat Keluar</a>
          </li>               
        </ul>
      </li>

      {{-- jurusan --}}
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-purple-500 ti-write"></i>
          </span>
          <span class="title">Surat</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Pengajuan</a>
            <a class="sidebar-link ">Terverifikasi</a>
            <a class="sidebar-link ">Ditolak</a>
            <a class="sidebar-link ">Cetak</a>
            <a class="sidebar-link ">Menunggu Persetujuan</a>
            <a class="sidebar-link ">Disetujui</a>
            <a class="sidebar-link ">Selesai</a>
          </li>               
        </ul>
      </li>

      {{-- Mahasiswa --}}
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-green-500 ti-write"></i>
              </span>
              <span class="title">Buat Surat</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-blue-500 ti-agenda"></i>
              </span>
              <span class="title">Status Surat</span>
          </a>
      </li>
      
      {{-- rektor --}}
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-green-500 ti-email"></i>
            </span>
          <span class="title">Surat Masuk</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Menunggu Disposisi</a>
            <a class="sidebar-link ">Surat Masuk</a>
          </li>               
        </ul>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-500 ti-files"></i>
              </span>
              <span class="title">Surat Keluar</span>
          </a>
      </li>

      {{-- sekretariat --}}
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-green-500 ti-email"></i>
              </span>
              <span class="title">Surat Masuk</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-500 ti-files"></i>
              </span>
              <span class="title">Surat Keluar</span>
          </a>
      </li>

      {{-- unit --}}
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-green-500 ti-email"></i>
              </span>
              <span class="title">Surat Masuk</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-500 ti-files"></i>
              </span>
              <span class="title">Surat Keluar</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-blue-500 ti-folder"></i>
              </span>
              <span class="title">Surat Internal</span>
          </a>
      </li>
      <li class="nav-item">
          <hr class="rounded" style="border-top: 3px solid #89CFF0; border-radius: 5px;">
          <h4 class="pl-4">E-SURAT</h4>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-purple-500 ti-notepad"></i>
            </span>
          <span class="title">Surat Akademik</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Menunggu Persetujuan</a>
            <a class="sidebar-link ">Disetujui</a>
          </li>               
        </ul>
      </li>

      {{-- warektor --}}
      <li class="nav-item">
        <hr class="rounded" style="border-top: 3px solid #89CFF0; border-radius: 5px;">
        <h4 class="pl-4">E-SURAT</h4>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
            <i class="c-purple-500 ti-notepad"></i>
          </span>
          <span class="title">Surat Akademik</span>
          <span class="arrow">
            <i class="ti-angle-right"></i>
          </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Menunggu Persetujuan</a>
            <a class="sidebar-link ">Disetujui</a>
          </li>               
        </ul>
      </li>
      <li class="nav-item">
          <hr class="rounded" style="border-top: 3px solid #89CFF0; border-radius: 5px;">
          <h4 class="pl-4">E-OFFICE</h4>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="javascript:void(0);">
          <span class="icon-holder">
              <i class="c-green-500 ti-email"></i>
            </span>
          <span class="title">Surat Masuk</span>
          <span class="arrow">
              <i class="ti-angle-right"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="sidebar-link ">Menunggu Disposisi</a>
            <a class="sidebar-link ">Surat Masuk</a>
          </li>               
        </ul>
      </li>
      <li class="nav-item">
          <a class="sidebar-link ">
              <span class="icon-holder">
                  <i class="c-red-500 ti-files"></i>
              </span>
              <span class="title">Surat Keluar</span>
          </a>
      </li>
    </ul>
    <br>
    <br>
    <br>
    <br>
  </div>
</div>