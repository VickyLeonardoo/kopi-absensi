@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <a href="/admin/izin/data-izin" style="font-size: 26px"><i class="fa-solid fa-arrow-left"></i> Izin Cuti/Sakit</a>
        <div style="color: black" class=" mt-5 ml-5 py-5 mr-5">
            <h4>
               <b> Request Izin</b>
            </h4>

            <div class="card rounded">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <p><b>Nama Karyawan</b></p>
                            <p><b>Ket. Izin</b></p>
                            <p><b>Tanggal Izin</b></p>
                            <p><b>Foto Bukti</b></p>
                        </div>
                        <div class="col-md-3">
                            <p><b>:{{ $izin->user->nama }}</b></p>
                            <p><b>:{{ $izin->keterangan->nama }}</b></p>
                            <p><b>{{ \Carbon\Carbon::parse($izin->tglIzin)->isoFormat('dddd, D MMMM Y') }}</b></p>
                            <p>:<img src="{{ asset('storage/' . $izin->fotoIzin) }}" alt="" height="250px" width="300px"></p>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $izin->user_id }}">
                    <div style="text-align: right" class="mb-3 mr-3">
                        <button class="btn" type="submit" formaction="{{ route('izin.setuju',$izin->id) }}" onact style="background-color: #6ace03; color:white; border-radius:30px; width: 10%;">Setuju</button>
                        <button class="btn" type="submit" formaction="{{ route('izin.tolak',$izin->id) }}" style="background-color: #ff0044; color:white; border-radius:30px; width: 10%;">Tolak</button>
                    </div>
                </form>

            </div>
        </div>

    </section>
</section>
@endsection
