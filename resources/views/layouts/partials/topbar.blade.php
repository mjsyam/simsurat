<nav class="navbar py-3 bg-white">
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
                <li class="">
                    <a href="" class="btn">
                        <i class="ti-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('received.letter-index')}}" class="btn">
                        <i class="ti-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                </li>
                <li class="">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn">
                            <i class="ti-power-off"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
