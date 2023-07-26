<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('asset') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ Route::is('pegawai.home*') ? 'menu-open' : '' }}">
                    <a href="/pegawai/home" class="nav-link {{ Route::is('pegawai.home*') ? 'active' : '' }}">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                <hr style="background-color:dimgray">
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Route::is('pegawai.absen*','absen.*','izin.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pegawai/absen"
                                class="nav-link {{ Route::is('absen.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-store nav-icon"></i>
                                <p>Absen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/master-data/shift"
                                class="nav-link {{ Route::is('shift.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-rotate nav-icon"></i>
                                <p>My Absen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pegawai/izin"
                                class="nav-link {{ Route::is('izin.*') ? 'active' : '' }}">
                                <i class="fa-solid fa-sticky-note nav-icon"></i>
                                <p>Izin</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
