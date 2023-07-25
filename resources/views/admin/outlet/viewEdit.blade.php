@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="form">
                        <form action="{{ route('outlet.update',$outlet->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Outlet:</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Outlet" name="nama" value="{{ $outlet->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Outlet:</label>
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Outlet" name="alamat" value="{{ $outlet->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="">Foto Outlet:</label>
                                <input type="file" class="form-control" name="foto">
                                <hr>
                                <img src="{{ asset('storage/' . $outlet->foto) }}" alt="Gambar Outlet" width="50">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn-primary form-control" value="SIMPAN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection
