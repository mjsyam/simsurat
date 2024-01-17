<nav class="navbar sticky-top navbar-expand-md navbar-light card" style="margin:30px;">
    <div class="container-fluid" style="padding:0px">
        <span type="button" id="sidebarCollapse" class="btn text-white" style="background-color:#0067b3; color: white !important">
            <i class="fa-solid fa-bars" style="color: white !important"></i>
        </span>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle bg-white" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;">
                {{ Auth::user()->name }}
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"
                style="width:250px;font-size:13px">
                <div class="row pl-3 pr-3 pt-2 pb-1">
                    <div class="col align-self-center">
                        <div class="custom-scroll" style="height:20px;overflow-y:hidden">
                            <p class="font-weight-bold mb-0">
                                {{ Auth::user()->name }}
                            </p>
                        </div>
                        <a>{{ Auth::user()->number }}</a>
                    </div>
                </div>
                <hr width="85%">

                <div class="row pt-0 pb-1">
                    <div class="col">
                        <a class="dropdown-item text-left" href="{{route('received.letter-index')}}"><i class="fa-regular fa-bell fa-fw mr-2"></i>Notifikasi</a>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn text-left">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span style="color:#FF5722">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
