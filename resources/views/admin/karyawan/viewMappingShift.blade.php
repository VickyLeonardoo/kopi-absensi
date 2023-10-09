@extends('partials.admin.header')
@section('content')
    <section class="content">
        <section class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="form">
                                <form action="{{ route('karyawan.simpan.mapping',$karyawan->slug) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Shift</label>
                                        <select name="shift_id" class="form-control">
                                            @foreach ($shift as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }} ({{ $data->jamMasuk }} -
                                                    {{ $data->jamPulang }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tglMulai">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tglAkhir">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <h2 style="text-align: center">{{ $karyawan->nama }}</h2>
                            <hr>
                            <div class="form">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Shift Pegawai</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($absensi as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->tglAbsen)->isoFormat('D MMMM Y') }} </td>
                                                <td>{{ $data->shift->nama }}</td>
                                                <td>{{ $data->shift->jamMasuk }}</td>
                                                <td>{{ $data->shift->jamPulang }}</td>
                                                <td>
                                                    <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
