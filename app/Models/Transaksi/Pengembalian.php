<?php

namespace App\Models\Transaksi;

use App\Models\Master\Buku;
use Database\Factories\PengembalianFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';

    protected $fillable = ['buku_id', 'tanggal_kembali'];

    protected static function newFactory()
    {
        return PengembalianFactory::new();
    }

    /* RULE
    *  setiap pengembalian hanya dilakukan untuk 1 buku
    */
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
