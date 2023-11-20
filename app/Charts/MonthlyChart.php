<?php

namespace App\Charts;

use App\Models\User;
use App\Models\Absensi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    private $slug;

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $user = User::where('slug', $this->getSlug())->first();
        $tanggalAwalBulan = now()->startOfMonth();
        $tanggalSekarang = now();

        $jumlahKehadiran = Absensi::where('user_id', $user->id)
            ->where('status', 'Hadir')
            ->whereBetween('tglAbsen', [$tanggalAwalBulan, $tanggalSekarang])
            ->count();

        $jumlahTidakHadir = Absensi::where('user_id', $user->id)
            ->where('status', 'Tidak Hadir')
            ->whereBetween('tglAbsen', [$tanggalAwalBulan, $tanggalSekarang])
            ->count();

        return $this->chart->pieChart()
            ->setTitle('Kehadiran Bulan Ini')
            ->setSubtitle('Statistik kehadiran untuk ' . $user->nama)
            ->addData([$jumlahKehadiran, $jumlahTidakHadir])
            ->setLabels(['Hadir', 'Tidak Hadir']);
    }
}
