<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @yield('sidebar_pokja_1')
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @php
        $role = Auth::guard('pokja_1')->user()->role;
        $routePrefix = "{$role}.";
        $dashboardRoute = $routePrefix . 'dashboard';
    @endphp
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route($dashboardRoute) }}" class="b-brand text-primary">
                    {{-- <img src="{{ asset('assets_admin/images/logo_pkk.png') }}"
                        alt="logo"> --}}
                    <h4>PKK Cipinang Melayu RW</h4>
                </a>
                {{-- <img src="../assets_admin/images/logo-dark.svg" >
                <a href="../dashboard/index.html" class="b-brand text-primary">
                </a> --}}
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item {{ request()->routeIs($dashboardRoute) ? 'pc-active' : '' }}">
                        <a href="{{ route($dashboardRoute) }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Data</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'papan_data') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Program Kerja / Evaluasi</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Pages</label>
                        <i class="ti ti-news"></i>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'news') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'news') }}" class="pc-link"> --}}
                                        <li class="pc-item {{ request()->routeIs($routePrefix . 'dokumentasi') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'dokumentasi') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-camera"></i></span>
                            <span class="pc-mtext">Dokumentasi</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'news') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'news') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-certificate"></i></span>
                            <span class="pc-mtext">Kliping</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'news') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'news') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Kemitraan</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'news') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'news') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mail"></i></span>
                            <span class="pc-mtext">Kumpulan SK</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'news') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'news') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                            <span class="pc-mtext">Rukun Kematian</span>
                        </a>
                    </li>


                    <li class="pc-item pc-caption">
                        <label>Other</label>
                        <i class="ti ti-brand-chrome"></i>
                    </li>
                    {{-- <li class="pc-item {{ request()->routeIs($routePrefix . 'bagan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'bagan') }}" class="pc-link"> --}}
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-building-community"></i></span>
                            <span class="pc-mtext">Kelompok Jimpitan</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-book"></i></span>
                            <span class="pc-mtext">Buku Data</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            {{-- <li
                                class="pc-item {{ request()->routeIs($routePrefix . 'struktural') ? 'pc-active' : '' }}">
                                <a class="pc-link" href="{{ route($routePrefix . 'struktural') }}">Struktur Rukun
                                    Warga</a> --}}
                            <li class="pc-item">
                                <a href="#" class="pc-link">
                                    <span class="pc-mtext">Buku Anak Yatim</span>
                                </a>
                            </li>
                            {{-- <li
                                class="pc-item {{ request()->routeIs($routePrefix . 'struktural') ? 'pc-active' : '' }}">
                                <a class="pc-link" href="{{ route($routePrefix . 'struktural') }}">Struktur Rukun
                                    Warga</a> --}}
                            <li class="pc-item">
                                <a href="#" class="pc-link">
                                    <span class="pc-mtext">Buku BKR</span>
                                </a>
                            </li>
                            {{-- <li
                                class="pc-item {{ request()->routeIs($routePrefix . 'struktural') ? 'pc-active' : '' }}">
                                <a class="pc-link" href="{{ route($routePrefix . 'struktural') }}">Struktur Rukun
                                    Warga</a> --}}
                            <li class="pc-item">
                                <a href="#" class="pc-link">
                                    <span class="pc-mtext">Buku Kerja Bakti</span>
                                </a>
                            </li>
                            <li {{-- class="pc-item {{ request()->routeIs($routePrefix . 'strukturalpkk') ? 'pc-active' : '' }}">
                                <a class="pc-link" href="{{ route($routePrefix . 'strukturalpkk') }}">Struktur PKK
                                    Anyelir</a> --}} class="pc-item">
                                <a href="#" class="pc-link">
                                    <span class="pc-mtext">Buku Lansia</span>
                                </a>
                            </li>
                            <li {{-- class="pc-item {{ request()->routeIs($routePrefix . 'strukturalkatar') ? 'pc-active' : '' }}">
                                <a class="pc-link" href="{{ route($routePrefix . 'strukturalkatar') }}">Struktur
                                    Karang
                                    Taruna</a> --}} class="pc-item">
                                <a href="#" class="pc-link">
                                    <span class="pc-mtext">Buku Majelis Taklim</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    {{-- <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-bell"></i>
                            <span class="badge bg-success pc-h-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notification</h5>
                                <a href="#!" class="pc-head-link bg-transparent"><i
                                        class="ti ti-circle-check text-success"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="shrink-0">
                                                <div class="user-avtar bg-light-success"><i class="ti ti-gift"></i>
                                                </div>
                                            </div>
                                            <div class="grow ms-1">
                                                <span class="float-end text-muted">3:00 AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.
                                                </p>
                                                <span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="shrink-0">
                                                <div class="user-avtar bg-light-primary"><i
                                                        class="ti ti-message-circle"></i></div>
                                            </div>
                                            <div class="grow ms-1">
                                                <span class="float-end text-muted">6:00 PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                                                <span class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="shrink-0">
                                                <div class="user-avtar bg-light-danger"><i class="ti ti-settings"></i>
                                                </div>
                                            </div>
                                            <div class="grow ms-1">
                                                <span class="float-end text-muted">2:45 PM</span>
                                                <p class="text-body mb-1">Your Profile is Complete &nbsp;<b>60%</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="shrink-0">
                                                <div class="user-avtar bg-light-primary"><i class="ti ti-headset"></i>
                                                </div>
                                            </div>
                                            <div class="grow ms-1">
                                                <span class="float-end text-muted">9:10 PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b>
                                                        Meeting.</b></p>
                                                <span class="text-muted">Daily scrum meeting time</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link me-0" href="#" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas_pc_layout">
                            <i class="ti ti-settings"></i>
                        </a>
                    </li> --}}
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}" alt="user-image"
                                class="user-avtar">
                            <span>{{ Auth::guard('pokja_1')->user()->name ?? 'Guest' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <div class="d-flex mb-1 align-items-center">
                                    <div class="grow ms-3">
                                        <h6 class="mb-1">{{ Auth::guard('pokja_1')->user()->name ?? 'Guest' }}</h6>
                                        <span>{{ Auth::guard('pokja_1')->user()->role ?? 'Tidak Ada Role' }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <a href="{{ route('profil') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>Detail Akun</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"
                                    style="border:none; background:none; width:100%; text-align:left;">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
</body>
