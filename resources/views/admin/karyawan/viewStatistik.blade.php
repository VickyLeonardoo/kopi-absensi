@extends('partials.admin.header')
@section('content')
@section('chart')
    <script src="{{ $statistikChart->cdn() }}"></script>
    {{ $statistikChart->script() }}
@endsection
<?php
    $telat = $totalTelat;
    $jam   = floor($telat / (60 * 60));
    $menit = $telat - ( $jam * (60 * 60) );
    $menit2 = floor( $menit / 60 );
    $detik = $telat % 60;
?>
<section class="content">
    <section class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-transparent">
                    <div class="inner">
                        <h3>@currency($gaji)<sup style="font-size: 20px"></sup></h3>
                        <p class="text-danger">Informasi Gaji Terdapat Dideskripsi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn"></i>
                            Deskripsi Gaji
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="callout callout-success">
                            <h5>Kehadiran</h5>
                            <p>{{ $hadir }} Hari</p>
                        </div>
                        <div class="callout callout-info">
                            <h5>Gaji Perhari</h5>
                            <p>@currency($gajiPerHariDb)</p>
                        </div>
                        <div class="callout callout-warning">
                            <h5>Telat</h5>
                            <p>{{ $jam." Jam ".$menit2." Menit" }}</p>
                        </div>
                        <div class="callout callout-danger">
                            <h5>Potongan Telat</h5>
                            <p>@currency($totalPotonganTelat)</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-6">
                <div class="card">
                    {!! $statistikChart->container() !!}
                </div>
            </div>
        </div>
    </section>
</section>
@endsection
