  <footer class="main-footer" style="position: fixed;right: 0;bottom: 0;left:0;z-index:10000;">
    <div class="row">
        <div class="col">
            <a class="btn btn-block" href="{{ url('/pegawai/home') }}"><i class="fa fas fa-home" style="{{ Request::is('pegawai.*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ route::is('pegawai.*') ? 'color: blue' : '' }}">Home</b></a>
        </div>
        <div class="col">
            <a class="btn btn-block" href="{{ url('/pegawai/izin') }}"><i class="fa fas fa-hourglass-half" style="{{ route::is('izin.*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ route::is('izin.*') ? 'color: blue' : '' }}">Cuti</b></a>
        </div>
        <div class="col">
            <a class="btn btn-block" href="{{ url('/pegawai/absen') }}"><i class="fa fas fa-camera" style="{{ route::is('absen*') ? 'color: blue' : '' }}"></i><br><b style="font-size: 12px; {{ route::is('absen*') ? 'color: blue' : '' }}">Absen</b></a>
        </div>
    </div>
</footer>
