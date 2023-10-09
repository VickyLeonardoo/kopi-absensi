@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container container-fluid">
        <div class="text-right">
            <a href="{{ route('owner.admin') }}" class="btn btn-primary">Kembali</a>
        </div>
        <h4><b>Karyawan Penkopi To Go</b></h4>
        <h1 style="color: #2d64ed; font-weight:bold;">{{ $admin->nama }}</h1>

        <form action="{{ route('owner.admin.update', $admin->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">No Id:</label>
                <input type="text" value="{{ $admin->id }}" readonly class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nama Admin:</label>
                <input type="text" value="{{ $admin->nama }}" name="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" value="{{ $admin->email }}" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="">No Telpon:</label>
                <input type="number" value="{{ $admin->noTelp }}" name="noTelp" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan" style="border-radius: 20px">
                <a href="{{ route('owner.admin.hapus',$admin->id) }}" class="btn" value="Simpan" onclick="return confirm('Ingin Menghapus Data Admin {{ $admin->nama }}?')" style="border-radius: 20px; background-color: #ff004d; color:white;">Hapus</a>
            </div>
        </form>
    </section>
</section>
@endsection
