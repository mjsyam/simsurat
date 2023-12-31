<div class="header navbar">
  <div class="header-container">
      <ul class="nav-left">
          <li>
              <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                  <i class="ti-menu"></i>
              </a>
          </li>
      </ul>
      <ul class="nav-right">
          <li class="dropdown">
              <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                  <div class="peer mR-10">
                      {{-- <img class="w-2r bdrs-50p" src="{{ auth()->user()->avatar }}" alt=""> --}}
                  </div>
                  <div class="peer">
                      {{-- <span class="fsz-sm c-grey-900">{{ auth()->user()->name }}</span> --}}
                  </div>
              </a>
              <ul class="dropdown-menu fsz-sm">
                  <li>
                      <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                          <i class="ti-user mR-10"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                      <a href="/logout" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                          <i class="ti-power-off mR-10"></i>
                          <span>Logout</span>
                      </a>
                  </li>
              </ul>
          </li>
          <li>
            <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
              <span class="icon-holder translate-middle">
                <i class="c-purple-500 ti-bell"></i>
                <span class="badge rounded-pill badge-notification bg-danger">1</span>
              </span>
            </a>
            <ul class="dropdown-menu fsz-sm">
                <li>
                    <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-user mR-10"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <form action="/logout" method="POST">
                        <button class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-power-off mR-10"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
          </li>
      </ul>
  </div>
</div>
