<?php

namespace App\Livewire\Transaksi;

use App\Models\Master\Buku as ModelBuku;
use App\Models\Transaksi\Pengembalian as ModelPengembalian;
use App\Models\Transaksi\Peminjaman as ModelPeminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Pengembalian extends Component
{
    use WithPagination;

    public $judulBuku = '';
    public $peminjaman = [];

    public function render()
    {
        return view(
            'livewire.transaksi.pengembalian',
            [
                // karena pengembalian->buku tidak work (belum ditemukan masalahnya), jadi menggunakan join, select
                'pengembalian' => ModelPengembalian::join('buku', 'pengembalian.buku_id', '=', 'buku.id')
                    ->join('peminjaman', 'buku.id', '=', 'peminjaman.buku_id')
                    ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
                    ->select(
                        'pengembalian.tanggal_kembali as tanggal_kembali',
                        'buku.judul_buku as judul_buku',
                        'anggota.nama as nama_anggota',
                        'peminjaman.tanggal_peminjaman as tanggal_pinjam'
                    )
                    ->paginate(10),
                'breadcrumbs' => Str::of(Request::path())->explode('/')
            ]
        );
    }

    public function searchBuku()
    {
        if (Str::length($this->judulBuku) >= 3) {
            // sedikit kompleks karna perlu mengecek apakah peminjaman memiliki tanggal pengembalian
            $this->peminjaman = ModelPeminjaman::join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
                ->leftJoin('pengembalian', 'pengembalian.buku_id', '=', 'buku.id')
                ->where('buku.judul_buku', 'like', "%$this->judulBuku%")
                ->whereNull('pengembalian.id')
                ->select(
                    'buku.id as buku_id',
                    'buku.judul_buku as judul_buku',
                    'anggota.nama as nama_anggota',
                    'peminjaman.tanggal_peminjaman as tanggal_pinjam'
                )->get();
        } else {
            $this->dispatch('toast', ['', 'Mohon periksa kembali input anda', 'error']);
        }
    }

    public function onClickPengembalian($peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            ModelPengembalian::create([
                'buku_id' => $peminjaman['buku_id'],
                'tanggal_kembali' => Carbon::now()->format('Y-m-d')
            ]);

            $this->dispatch('toast', ['', 'Pengembalian berhasil', 'success']);
            $this->resetSearchBuku();
        });
    }

    public function resetSearchBuku()
    {
        $this->judulBuku = '';
        $this->peminjaman = [];
    }
}
