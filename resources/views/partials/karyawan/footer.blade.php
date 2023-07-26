  <footer class="main-footer" style="position: fixed;right: 0;bottom: 0;left:0;z-index:10000;">
    <div class="row">
        <div class="col">
            <a class="btn btn-block" href="{{ url('/dashboard') }}"><i class="fa fas fa-home" style="{{ Request::is('dashboard*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ Request::is('dashboard*') ? 'color: blue' : '' }}">Home</b></a>
        </div>
        <div class="col">
            <a class="btn btn-block" href="{{ url('/cuti') }}"><i class="fa fas fa-hourglass-half" style="{{ Request::is('cuti*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ Request::is('cuti*') ? 'color: blue' : '' }}">Cuti</b></a>
        </div>
        <div class="col">
            <a class="btn btn-block" href="{{ url('/absen') }}"><i class="fa fas fa-camera" style="{{ route::is('absen*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ route::is('absen*') ? 'color: blue' : '' }}">Absen</b></a>
        </div>
        <div class="col">
            <a class="btn btn-block" href="{{ url('/pegawai/izin') }}"><i class="fa fas fa-user-secret" style="{{ route::is('izin.*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ route::is('izin.*') ? 'color: blue' : '' }}">Izin</b></a>
        </div>
    </div>
</footer>
