@extends('partials.karyawan.header')
@section('content')
<section class="content">
    <section class="container-fluid">
        @php
        $jam = date('H');
        if ($jam >= 5 && $jam < 12) {
            $waktu = "Pagi";
        } elseif ($jam >= 12 && $jam < 15) {
            $waktu = "Siang";
        } elseif ($jam >= 15 && $jam < 18) {
            $waktu = "Sore";
        } else {
            $waktu = "Malam";
        }

        $bulan = date('m');
        if ($bulan == '01') {
            $namaBulan = "Januari";
        } elseif ($bulan == '02') {
            $namaBulan = "Februari";
        } elseif ($bulan == '03') {
            $namaBulan = "Maret";
        }  elseif ($bulan == '04') {
            $namaBulan = "April";
        } elseif ($bulan == '05') {
            $namaBulan = "Mei";
        } elseif ($bulan == '06') {
            $namaBulan = "Juni";
        } elseif ($bulan == '07') {
            $namaBulan = "Juli";
        } elseif ($bulan == '08') {
            $namaBulan = "Agustus";
        } elseif ($bulan == '09') {
            $namaBulan = "September";
        } elseif ($bulan == '10') {
            $namaBulan = "Oktober";
        } elseif ($bulan == '11') {
            $namaBulan = "November";
        } else {
            $namaBulan = "Desember";
        }


        $tanggal_mulai = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
    @endphp
    @if($shift_karyawan->count() > 0)
        @foreach ($shift_karyawan as $sk)
            <?php $skid = $sk->id ?>
            <?php $sktanggal = $sk->tglAbsen ?>
            <?php $sknamas = $sk->shift->nama  ?>
            <?php $skjamas = $sk->shift->jamMasuk ?>
            <?php $skjamkel = $sk->shift->jamPulang ?>
            <?php $skjamab = $sk->jamIn ?>
            <?php $skjampul = $sk->jamOut ?>
            <?php $skstatus = $sk->status ?>
        @endforeach
    @else
        <?php $skid = "-" ?>
        <?php $sktanggal = "-" ?>
        <?php $sknamas = "-"  ?>
        <?php $skjamas = "-" ?>
        <?php $skjamkel = "-" ?>
        <?php $skjamab = "-" ?>
        <?php $skjampul = "-" ?>
        <?php $skstatus = "-" ?>
    @endif
    <div class="ml-2 mr-2">
        <div class="card p-4" style="border-radius: 20px">
            <div class="row">
                <div class="col-8">
                    <b>Selamat {{ $waktu }}</b>
                </div>
                <div class="col-4">
                    <b>Jam Kerja</b>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-8">
                    <h1>{{ auth()->user()->name }}</h1>
                </div>
                <div class="col-4">
                    {{-- {{ $skjamas }} <br> - <br> {{  $skjamkel }} --}}
                </div>
            </div>
            <hr style="background-color:dimgray">
            <center>
                <div class="row mt-4">
                    <div class="col">
                        <a href="{{ url('/absen') }}" class="btn btn-lg" style="background-color: crimson; border-radius: 20px"><i class="fa fa-camera" style="color: white"></i></a>
                        <p class="mt-2"><b style="font-size: 14px">Absen</b></p>
                    </div>
                    <div class="col">
                        <a href="{{ url('/my-absen') }}" class="btn btn-lg" style="background-color: rgb(211, 160, 94); border-radius: 20px"><i class="fa fa-user-secret" style="color: white"></i></a>
                        <p class="mt-2"><b style="font-size: 14px">My Absen</b></p>
                    </div>
                    <div class="col">
                        <a href="{{ url('/cuti') }}" class="btn btn-lg" style="background-color: rgb(66, 91, 190); border-radius: 20px"><i class="fa fa-hourglass-half" style="color: white"></i></a>
                        <p class="mt-2"><b style="font-size: 14px">Cuti</b></p>
                    </div>
                    <div class="col">
                        <a href="{{ url('/my-dokumen') }}" class="btn btn-lg" style="background-color: rgb(57, 112, 78); border-radius: 20px"><i class="fa fa-folder" style="color: white"></i></a>
                        <p class="mt-2"><b style="font-size: 14px">Document</b></p>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <div class="ml-2 mr-2 mt-4">
        <center>
            <div class="row">
                <div class="col">
                    <div class="card p-3" style="border-radius: 20px; background-color:rgb(223, 117, 78); color:white">
                        <span>Absen Masuk</span>
                        @if ($skjamab == null)
                            <b>Belum Masuk</b>
                        @else
                            <b>Jam : {{ $skjamab }}</b>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="card p-3" style="border-radius: 20px; background-color:gray; color:white">
                        <span>Absen Pulang</span>
                        @if ($skjampul == null)
                            <b>Belum Pulang</b>
                        @else
                            <b>Jam : {{ $skjampul }}</b>
                        @endif
                    </div>
                </div>
            </div>
        </center>
    </div>
    <div class="ml-2 mr-2 mt-2">
       <div class="card p-4" style="border-radius: 20px">
        <center>
            <b>Absensi Bulan {{ $namaBulan }}</b>
        </center>
        <div class="row mt-4">
            <div class="col">
                <div class="card p-3" style="background-color: rgb(227, 229, 228); border-radius: 20px;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-sign-out-alt mt-2" style="font-size: 40px"></i>
                        </div>
                        <div class="col">
                            <h6><b>Hadir</b></h6>
                            {{ Auth::guard('user')->user()->absensi->whereBetween('tglAbsen', [$tanggal_mulai, $tanggal_akhir])->where('status', '=', 'Hadir')->count() }} Hari
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3" style="background-color: rgb(227, 229, 228); border-radius: 20px;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-hourglass-half mt-2" style="font-size: 40px"></i>
                        </div>
                        <div class="col">
                            <h6><b>Cuti</b></h6>
                            {{-- {{ auth()->user()->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', '=', 'Cuti')->count() }} Hari --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card p-3" style="background-color: rgb(227, 229, 228); border-radius: 20px;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-stopwatch mt-2" style="font-size: 40px"></i>
                        </div>
                        <div class="col">
                            <h6><b>Telat</b></h6>
                            {{-- @php
                                $total_telat = auth()->user()->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('telat');
                                $jam   = floor($total_telat / (60 * 60));
                                $menit = $total_telat - ( $jam * (60 * 60) );
                                $menit2 = floor($menit / 60);
                            @endphp
                            @if($jam <= 0 && $menit2 <= 0)
                                - -
                            @else
                                {{ $jam." Jam ".$menit2." Menit" }}
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3" style="background-color: rgb(227, 229, 228); border-radius: 20px;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-history mt-2" style="font-size: 40px"></i>
                        </div>
                        <div class="col">
                            <h6 style="font-size: 13.5px"><b>Pulang Cepat</b></h6>
                            {{-- @php
                                $total_pulang_cepat = auth()->user()->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('pulang_cepat');
                                $jam_cepat   = floor($total_pulang_cepat / (60 * 60));
                                $menit_cepat = $total_pulang_cepat - ( $jam_cepat * (60 * 60) );
                                $menit_cepat2 = floor($menit_cepat / 60);
                            @endphp
                            @if($jam_cepat <= 0 && $menit_cepat2 <= 0)
                                - -
                            @else
                                {{ $jam_cepat." Jam ".$menit_cepat2." Menit" }}
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
    </section>
</section>

@endsection
