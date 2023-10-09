@extends('partials.admin.header')
@section('content')
<section class="content ml-5 mr-5">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body box-profile">
                <div class="text-left" style="font-size: 30px; font-weight:bold;">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('asset') }}/dist/img/user4.jpg " alt="User profile picture">
                        &nbsp;&nbsp;&nbsp;&nbsp;Admin <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="/admin/password" class="btn btn-primary ml-5" style="width: 10%; text-white;">Ubah Password</a>
                </div>
                <br>
                <br>
                <div class="col-md-6">
                    <h4><b>Informasi Pribadi</b></h4>
                </div>
                <br>
                <br>
                <form action="/admin/update-profile" method="POST">
                    @csrf
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" style="background-color: #d9d9d9" name="nama" value="{{ Auth()->user()->nama }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="text" class="form-control" style="background-color: #d9d9d9" name="email" value="{{ Auth()->user()->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="">No Telfon</label>
                        <input type="text" class="form-control" style="background-color: #d9d9d9" name="noTelp" value="{{ Auth()->user()->noTelp }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
</section>
@endsection
