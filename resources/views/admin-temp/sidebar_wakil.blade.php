<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @yield('sidebar_wakil')
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @php
        $role = Auth::guard('wakil')->user()->role;
        $routePrefix = "{$role}.";
        $dashboardRoute = $routePrefix . 'dashboard';
    @endphp
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route($dashboardRoute) }}" class="b-brand text-primary">
                    <h4>PKK Cipinang Melayu RW</h4>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item {{ request()->routeIs($dashboardRoute) ? 'pc-active' : '' }}">
                        <a href="{{ route($dashboardRoute) }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    {{-- =============== KEUANGAN (Bendahara) =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Keuangan</label>
                        <i class="ti ti-cash"></i>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'buku_keuangan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'buku_keuangan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-report-money"></i></span>
                            <span class="pc-mtext">Buku Keuangan</span>
                        </a>
                    </li>

                    {{-- =============== DATA SEKRETARIS =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Data Sekretaris</label>
                        <i class="ti ti-file-text"></i>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_data_umum') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_data_umum') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-database"></i></span>
                            <span class="pc-mtext">Data Umum</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'sekretaris_data_potensi') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'sekretaris_data_potensi') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-location"></i></span>
                            <span class="pc-mtext">Data Potensi Wilayah</span>
                        </a>
                    </li>

                    {{-- =============== DATA POKJA 1 =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Data Pokja 1</label>
                        <i class="ti ti-users"></i>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja1_daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja1_daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'pokja1_kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja1_kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja1_agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja1_agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja1_papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja1_papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
                    </li>

                    {{-- =============== DATA POKJA 2 =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Data Pokja 2</label>
                        <i class="ti ti-users"></i>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja2_daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja2_daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'pokja2_kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja2_kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja2_agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja2_agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja2_papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja2_papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
                    </li>

                    {{-- =============== DATA POKJA 3 =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Data Pokja 3</label>
                        <i class="ti ti-users"></i>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja3_daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja3_daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'pokja3_kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja3_kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja3_agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja3_agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja3_papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja3_papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
                    </li>

                    {{-- =============== DATA POKJA 4 =============== --}}
                    <li class="pc-item pc-caption">
                        <label>Data Pokja 4</label>
                        <i class="ti ti-users"></i>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja4_daftar_anggota') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja4_daftar_anggota') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid-add"></i></span>
                            <span class="pc-mtext">Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="pc-item {{ request()->routeIs($routePrefix . 'pokja4_kegiatan') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja4_kegiatan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Kegiatan</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja4_agenda_surat') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja4_agenda_surat') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Agenda Surat</span>
                        </a>
                    </li>
                    <li
                        class="pc-item {{ request()->routeIs($routePrefix . 'pokja4_papan_data') ? 'pc-active' : '' }}">
                        <a href="{{ route($routePrefix . 'pokja4_papan_data') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Papan Data</span>
                        </a>
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
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="{{ asset('assets_admin/images/user/avatar-2.jpg') }}" alt="user-image"
                                class="user-avtar">
                            <span>{{ Auth::guard('wakil')->user()->name ?? 'Guest' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <div class="d-flex mb-1 align-items-center">
                                    <div class="grow ms-3">
                                        <h6 class="mb-1">{{ Auth::guard('wakil')->user()->name ?? 'Guest' }}</h6>
                                        <span>{{ Auth::guard('wakil')->user()->role ?? 'Tidak Ada Role' }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            {{-- <a href="{{ route('profil') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>Detail Akun</span>
                            </a> --}}
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
