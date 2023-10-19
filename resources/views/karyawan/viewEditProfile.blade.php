@extends('partials.karyawan.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-info">
                        Profile {{ auth()->user()->nama }}
                    </div>
                    <div class="card-body">
                        <form action="/karyawan/update-profile" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ auth()->user()->nama }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" readonly value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label>No Hp</label>
                                <input type="text" class="form-control" name="noTelp" value="{{ auth()->user()->noTelp }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Simpan Profile" class="btn btn-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-secondary">
                        Password
                    </div>
                    <div class="card-body">
                        <form action="/karyawan/update-password" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" class="form-control" name="password_lama" value="">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_konfirmasi" value="">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Simpan Password" class="btn btn-secondary form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
