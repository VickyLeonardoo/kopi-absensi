<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #f4f6f9">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset') }}/dist/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: black">{{ Auth::guard('user')->user()->nama }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li
                    class="nav-item {{ Route::is('admin.home*') ? 'menu-open' : '' }}">
                    <a href="/admin/home"
                        class="nav-link {{ Route::is('admin.home*') ? 'active' : '' }}" style="color: black">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                    <hr style="background-color:dimgray">
                </li>
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li
                    class="nav-item menu-open">
                    <a href="#"
                        class="nav-link {{ Route::is('outlet.*','shift.*','karyawan.*','keterangan.*') ? 'active' : '' }}" style="color: black">
                        <i class="fa-solid fa-database"></i>
                        <p >
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" >
                            <a href="/admin/master-data/outlet"
                                class="nav-link {{ Route::is('outlet.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-store nav-icon"></i>
                                <p >Outlet</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/master-data/shift"
                                class="nav-link {{ Route::is('shift.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-rotate nav-icon"></i>
                                <p>Shift</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/master-data/keterangan-izin" class="nav-link {{ Route::is('keterangan.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-note-sticky nav-icon"></i>
                                <p>Keterangan Izin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/master-data/karyawan"
                                class="nav-link {{ Route::is('karyawan.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-user nav-icon"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item menu-open">
                    <a href="#"
                        class="nav-link {{ Route::is('absensi.*') ? 'active' : '' }}" style="color: black">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/absensi/data-absensi"
                                class="nav-link {{ Route::is('absensi.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-table nav-icon"></i>
                                <p>Data Absensi</p>
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
