<?php

namespace App\Livewire\Transaksi;

use App\Models\Master\Anggota as ModelAnggota;
use App\Models\Master\Buku as ModelBuku;
use App\Models\Transaksi\Peminjaman as ModelPeminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Peminjaman extends Component
{
    use WithPagination;

    public $namaAnggota = '';
    public $anggota = [];
    public $selectedAnggota;
    public $judulBuku = '';
    public $buku = [];
    public $selectedBuku;

    public function render()
    {
        return view(
            'livewire.transaksi.peminjaman',
            [
                'peminjaman' => ModelPeminjaman::latest()->paginate(10),
                'breadcrumbs' => Str::of(Request::path())->explode('/')
            ]
        );
    }

    public function searchAnggota()
    {
        if (Str::length($this->namaAnggota) >= 3) {
            $this->anggota = ModelAnggota::where('nama', 'like', "%$this->namaAnggota%")->get();
        } else {
            $this->dispatch('toast', ['', 'Mohon periksa kembali input anda', 'error']);
        }
    }

    public function onClickAnggota($anggota)
    {
        $this->selectedAnggota = $anggota;
        $this->anggota = [];
    }

    public function searchBuku()
    {
        if (Str::length($this->judulBuku) >= 3) {
            $this->buku = modelBuku::where('judul_buku', 'like', "%$this->judulBuku%")->get();
        } else {
            $this->dispatch('toast', ['', 'Mohon periksa kembali input anda', 'error']);
        }
    }

    public function onClickBuku($buku)
    {
        $this->selectedBuku = $buku;
        $this->buku = [];
    }

    public function onClickSimpanPeminjaman()
    {
        $now = Carbon::now()->format('Y-m-d');
        if (!$this->selectedAnggota || !$this->selectedBuku) {
            $this->dispatch('toast', ['', 'Anggota atau Buku tidak valid', 'error']);
            return;
        }

        DB::transaction(function () use ($now) {
            ModelPeminjaman::create([
                'tanggal_peminjaman' => $now,
                'anggota_id' => $this->selectedAnggota['id'],
                'buku_id' => $this->selectedBuku['id']
            ]);

            $buku = ModelBuku::find($this->selectedBuku['id']);
            if ($buku && $buku->stock > 0) {
                $buku->decrement('stock');
            } else {
                $this->dispatch('toast', ['', 'Stok buku tidak mencukupi', 'warning']);
                return;
            }
        });

        $this->dispatch('toast', ['', 'Peminjaman Buku berhasil disimpan', 'success']);
        $this->onClickResetPeminjaman();
    }

    public function onClickResetPeminjaman()
    {
        $this->namaAnggota = '';
        $this->anggota = [];
        $this->selectedAnggota = null;
        $this->judulBuku = '';
        $this->buku = [];
        $this->selectedBuku = null;
    }
}
