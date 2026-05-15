<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @yield('sidebar_bendahara')
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @php
        $role = Auth::guard('bendahara')->user()->role;
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
                            <span>{{ Auth::guard('bendahara')->user()->name ?? 'Guest' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <div class="d-flex mb-1 align-items-center">
                                    <div class="grow ms-3">
                                        <h6 class="mb-1">{{ Auth::guard('bendahara')->user()->name ?? 'Guest' }}</h6>
                                        <span>{{ Auth::guard('bendahara')->user()->role ?? 'Tidak Ada Role' }}</span>
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
