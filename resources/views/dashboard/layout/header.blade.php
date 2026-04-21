<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        {{-- <img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22"> --}}
                        <img src="{{ asset('img/logo-final.png') }}" alt="" height="25">
                    </span>
                    <!--sidebuka-->
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19"> --}}
                        <img src="{{ asset('img/logo-final.png') }}" alt="" height="30">
                        <span class="text-white" style="font-size: 15px">
                            Reservasi Online
                        </span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->

            {{--  --}}
        </div>

        <div class="d-flex">

            {{-- <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i>
                        <span key="t-my-wallet">My
                            Wallet</span></a>
                    <a class="dropdown-item d-block" href="#"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                    <a class="dropdown-item" href="{{ route('dashboard.lock-screen') }}">
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock
                            screen</span></a> --}}
                    {{-- <form action="{{ route('recoverpw') }}" method="POST">
                        @csrf
                            <button type="submit" class="dropdown-item" style="text-align:center"><i
                            class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Recover Password</span></button>
                    </form>  --}}
                    {{-- <a href="{{ route('recoverpw') }}"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i>
                        <span key="t-lock-screen">Recover Password</span></a> --}}
                    {{-- @role(['admin'])
                        <form action="{{ route('recoverpw') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-black" style="text-align:center;"><i
                                    class="bx bxs-lock-alt font-size-16 align-middle me-1"><span> Lupa
                                        Password</span></i></button>
                        </form>
                    @endrole
                    @role(['mahasiswa', 'dosen'])
                        <form method="POST">
                            @csrf
                            <button type="button" class="dropdown-item" style="text-align:center;" id="sa-warning"><i
                                    class="bx bxs-trash-alt font-size-16 align-middle me-1"><span> Hapus
                                        Akun</span></i></button>
                        </form>
                    @endrole
                    <div class="dropdown-divider"></div> --}}

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        {{-- <a class="dropdown-item text-danger" href="#"><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                key="t-logout">Logout</span></a> --}}
                        
                        <button type="submit" class="dropdown-item text-danger" style="text-align:center"><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i><span
                                key="t-logout">Logout</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
