<nav class="navbar bg-white py-3">
    <div class="container-fluid">
        <a id='sidebar-toggle' class="btn sidebar-toggle" href="javascript:void(0);">
            <i class="ti-menu"></i>
        </a>

        <!-- Default dropstart button -->
        <div class="btn-group dropstart">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
            </button>
            <ul class="dropdown-menu">
                <!-- Dropdown menu links -->
                <li class="px-3">
                    <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-user mR-10"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="px-3">
                    <a href="/logout" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-power-off mR-10"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
