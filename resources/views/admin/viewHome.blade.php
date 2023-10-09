@extends('partials.admin.header')
@section('content')
<section class="content ml-5 mr-5">
    @if(session('message'))
        <h4>Hello {{ auth()->user()->nama }}</h4>
        <h1 style="color: rgb(35, 105, 220); font-size: 64px;"><b>{{ session('message') }}</b></h1>
    @endif
    <div class="row">
        <div class="container-fluid">
            <div class="position-relative">
                <img src="{{ asset('asset/img/dashboard.png') }}" width="100%" alt="">

            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <h3 style="color: rgb(35, 105, 220)">{{ $tglFormat }}</h3>
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box" style="background: white">
                    <div class="inner">
                        <h3>{{ $karyawan }}</h3>
                        <p>Karyawan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box" style="background: white">
                    <div class="inner">
                        <h3>{{ $outlet }}</h3>
                        <p>Outlet</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shop"></i>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role == 1)
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box" style="background: white">
                        <div class="inner">
                            <h3>{{ $admin }}</h3>
                            <p>Admin</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card card-default">
            <div class="card-header">
                <h5>Absensi Hari Ini</h5>
            </div>
            <div class="card-body">
                <table id="cekAbsensiHome" class="display">
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
                        @foreach($data_absen as $da)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $da->user->nama }}</td>
                                <td>{{ $da->shift->nama }}~({{ $da->shift->jamMasuk }} -
                                    {{ $da->shift->jamPulang }})</td>
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
                                        <span
                                            class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if(!$da->fotoMasuk)
                                        ~
                                    @else
                                        <img src="{{ asset('storage/' . $da->fotoMasuk) }}"
                                            alt="Gambar Foto Masuk" width="50">
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
                                        <span
                                            class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$da->fotoPulang)
                                        ~
                                    @else
                                        <img src="{{ asset('storage/' . $da->fotoPulang) }}"
                                            alt="Gambar Outlet" width="50">
                                    @endif
                                </td>

                                <td>
                                    @if($da->status == 'Pending')
                                        <span class="badge badge-warning">{{ $da->status }}</span>
                                </td>
                            @elseif($da->status == 'Hadir')
                                <span class="badge badge-success">{{ $da->status }}</span></td>
                            @else
                                <span class="badge badge-danger">{{ $da->status }}</span></td>
                        @endif
                        <td>
                            <button type="button" class="btn btn-success" title="Setuju " data-toggle="modal"
                                data-target="#modal-default-{{ $da->id }}"><i class="fas fa-tasks"></i></button>
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
@endsection
