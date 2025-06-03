<?php

namespace App\Models\Transaksi;

use App\Models\Master\Anggota;
use App\Models\Master\Buku;
use Carbon\Carbon;
use Database\Factories\PeminjamanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = ['tanggal_peminjaman', 'anggota_id', 'buku_id'];

    protected static function newFactory()
    {
        return PeminjamanFactory::new();
    }

    /* RULE
    *  setiap peminjaman hanya dilakukan oleh 1 anggota dan hanya 1 buku
    */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id')->withDefault([
            'id' => null,
            'tanggal_lahir' => Carbon::now()->toDateString(),
            'nama' => 'nama anggota tidak tercantum',
        ]);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id')->withDefault([
            'id' => null,
            'judul_buku' => 'Buku tidak tercantum',
            'penerbit' => '-',
            'dimensi' => '-',
            'stock' => 0
        ]);
    }
}
