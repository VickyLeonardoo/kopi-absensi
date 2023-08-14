<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #f4f6f9">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: black">{{ auth()->user()->nama }}</a>
                <small ><a style="color: black" href="/karyawan/edit-profile">Edit Profile</a></small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ Route::is('pegawai.home*') ? 'menu-open' : '' }}">
                    <a href="/pegawai/home" class="nav-link {{ Route::is('pegawai.home*') ? 'active' : '' }}" style="color: black">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                <hr style="background-color:dimgray">
                </li>

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ Route::is('pegawai.absen*','absen.*','izin.*','my.absen') ? 'active' : '' }}" style="color: black">
                        <i class="fa-solid fa-database"></i>
                        <p>
                            Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pegawai/absen"
                                class="nav-link {{ Route::is('absen.*') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-camera nav-icon"></i>
                                <p>Absen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pegawai/data-absen"
                                class="nav-link {{ Route::is('my.absen') ? 'active' : '' }}" style="color: black">
                                <i class="fa-solid fa-rotate nav-icon"></i>
                                <p>My Absen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pegawai/izin"
                                class="nav-link {{ Route::is('izin.*') ? 'active' : '' }}" style="color: black">
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
