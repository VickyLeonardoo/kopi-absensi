@extends('partials.admin.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-body">
                    <form action="{{ url('/admin/absensi/data-absensi') }}">
                        @csrf
                        <span>Filter Nama dan Rentang Tanggal</span><br><br>
                        <div class="form-row">
                            <div class="col-3">
                                <select name="user_id" id="user_id" class="form-control selectpicker"
                                    data-live-search="true">
                                    <option value="" selected>Pilih Pegawai</option>
                                    @foreach($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control flatpickr-input" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}" onfocus="(this.type='date')">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="akhir" placeholder="Tanggal Akhir"
                                    id="akhir" value="{{ request('akhir') }}" onfocus="(this.type='date')">
                            </div>
                            <div>
                                <button type="submit" id="search" class="form-control btn btn-primary"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <h3 class="card-title"></h3>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <table id="cekAbsensi" class="display">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pegawai</th>
                                <th>Shift</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Telat</th>
                                <th>Foto Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Pulang Cepat</th>
                                <th>Foto Pulang</th>
                                <th>Status Absen</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_absen as $da)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $da->user->nama }}</td>
                                    <td>{{ $da->shift->nama }}~({{ $da->shift->jamMasuk }} - {{ $da->shift->jamPulang }})</td>
                                    <td>{{ date('d-M-Y', strtotime($da->tglAbsen)); }}</td>
                                    <td>{{ $da->jamIn }}</td>
                                    <td>
                                        <?php
                                        $telat = $da->telat;
                                        $jam   = floor($telat / (60 * 60));
                                        $menit = $telat - ( $jam * (60 * 60) );
                                        $menit2 = floor( $menit / 60 );
                                        $detik = $telat % 60;
                                    ?>
                                        @if($jam <= 0 && $menit2 <= 0)
                                            <span class="badge badge-success">Tepat Waktu</span>
                                        @else
                                            <span class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if (!$da->fotoMasuk)
                                        ~
                                        @else
                                        <img src="{{ asset('storage/' . $da->fotoMasuk) }}" alt="Gambar Foto Masuk" width="50">
                                        @endif
                                    <td>{{ $da->jamOut }}</td>
                                    <td>
                                        <?php
                                        $telat = $da->pulangCepat;
                                        $jam   = floor($telat / (60 * 60));
                                        $menit = $telat - ( $jam * (60 * 60) );
                                        $menit2 = floor( $menit / 60 );
                                        $detik = $telat % 60;
                                    ?>
                                        @if($jam <= 0 && $menit2 <= 0)
                                            <span class="badge badge-success">Tepat Waktu</span>
                                        @else
                                            <span class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$da->fotoPulang)
                                        ~
                                        @else
                                        <img src="{{ asset('storage/' . $da->fotoPulang) }}" alt="Gambar Outlet" width="50">
                                        @endif
                                    </td>

                                    <td>{{ $da->status }}</td>
                                    <td>
                                        <a href="" class="btn btn-success" title="Konfirmasi Kehadiran"><i class="fas fa-check"></i></a>
                                        <a href="" class="btn btn-warning" title="Upload Foto"><i class="fas fa-rotate"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pegawai</th>
                                <th>Shift</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Telat</th>
                                <th>Foto Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Pulang Cepat</th>
                                <th>Foto Pulang</th>
                                <th>Status Absen</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection
