@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="form">
                        <form action="/admin/master-data/outlet/simpan-data" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Outlet:</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Outlet" name="nama" value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Outlet:</label>
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Outlet" name="alamat" value="{{ old('alamat') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Foto Outlet:</label>
                                <input type="file" class="form-control" placeholder="Masukkan Foto Outlet" name="foto" value="{{ old('foto') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Foto Outlet:</label>
                                <input type="submit" class="btn-primary form-control" value="SIMPAN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
