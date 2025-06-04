<?php

namespace App\Livewire;

use App\Models\Transaksi\Peminjaman as ModelPeminjaman;
use App\Models\Transaksi\Pengembalian as ModelPengembalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;

class Dashboard extends Component
{

    public function render()
    {
        // bagian ini dibantu dengan AI Copilot
        Carbon::setLocale('id');

        $peminjaman = ModelPeminjaman::whereBetween(
            'tanggal_peminjaman',
            [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]
        )->get();

        $pengembalian = ModelPengembalian::whereBetween(
            'tanggal_kembali',
            [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]
        )->get();

        $peminjamanByDay = $peminjaman->groupBy(
            fn($item) => Carbon::parse($item->tanggal_peminjaman)->translatedFormat('l')
        );
        $pengembalianByDay = $pengembalian->groupBy(
            fn($item) => Carbon::parse($item->tanggal_kembali)->translatedFormat('l')
        );

        $labels = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])
            ->map(fn($day) => Carbon::parse($day)->translatedFormat('l'))
            ->toArray();

        $peminjamanData = [];
        $pengembalianData = [];

        foreach ($labels as $day) {
            $peminjamanData[] = $peminjamanByDay->has($day) ? $peminjamanByDay[$day]->count() : 0;
            $pengembalianData[] = $pengembalianByDay->has($day) ? $pengembalianByDay[$day]->count() : 0;
        }

        $this->dispatch('updateChart', [
            'labels' => $labels,
            'peminjamanData' => $peminjamanData,
            'pengembalianData' => $pengembalianData,
            'backgroundColors' => [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)'
            ],
        ]);

        return view('livewire.dashboard', ['breadcrumbs' => Str::of(Request::path())->explode('/')]);
    }
}
