@extends('partials.karyawan.header')
@section('content')
<section class="content">
    <section class="container container-fluid">
        <h3 style="color: #4b87ee; font-weight:bold;">Request Izin</h3>
            <form action="{{ route('izin.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Keterangan Izin</label>
                    <select class="form-control" name="keterangan_id">
                        <option value="" selected disabled>Pilih Keterangan</option>
                        @foreach ($ket as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Izin</label>
                    <input type="date" class="form-control" name="tglIzin">
                </div>
                <div class="form-group">
                    <label for="">Foto Izin</label>
                    <input type="file" class="form-control" name="foto" value="{{ old('foto') }}" placeholder="Masukkan Nama Keterangan Izin">
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>

            @foreach ($izin as $cekIzin)
            @if ($cekIzin['status'] === 'Pending')
            <h3 style="color: #4b87ee; font-weight:bold;">Pending</h3>
                <div class="row">
                    <div class="col-md-3">
                        <p ><b>{{ \Carbon\Carbon::parse($cekIzin['tglIzin'])->isoFormat('dddd, D MMMM Y') }}</b></p>
                    </div>
                    <div class="col-md-3">
                        <p class="ml-3 mr-3 badge badge-warning"><b>Menunggu Persetujuan Admin</b></p>
                    </div>

                </div>
            @endif
        @endforeach


        <h3 style="color: #4b87ee; font-weight:bold;">Riwayat Izin</h3>
        <div class="row">
        @foreach ($riwayat as $data)
            <div class="col-md-3">
                <p ><b>{{ \Carbon\Carbon::parse($data->tglIzin)->isoFormat('dddd, D MMMM Y') }}</b></p>
            </div>
            <div class="col-md-3">
                    <p class="ml-3 mr-3 badge {{ $data->status == 'Setuju' ? 'badge-success':'badge-danger' }} "><b>{{ $data->status }}</b></p>
            </div>
        @endforeach
        </div>
        <div>
            {{ $riwayat->links() }}
        </div>

        {{-- <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-info" title="Tambah Data" data-toggle="modal" data-target="#modal-request"><i class="fas fa-plus"></i>Request Izin</button>
            </div>
            <div class="card-body">
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ket Izin</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->keterangan->nama }}</td>
                                <td>{{ $data->tglIzin }}</td>
                                <td><img src="{{ asset('storage/' . $data->fotoIzin) }}" alt="Gambar Izin" width="50">
                                <td>
                                    @if ($data->status == 'Pending')
                                        <span class="badge badge-warning">{{ $data->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $data->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Ket Izin</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div> --}}


    </section>
</section>
@include('karyawan.izin.modal')
@endsection
