<?php

namespace App\Models\Master;

use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\Pengembalian;
use Database\Factories\BukuFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'buku';

    protected $fillable = ['judul_buku', 'penerbit', 'dimensi', 'stock'];

    protected static function newFactory()
    {
        return BukuFactory::new();
    }

    /* RULE RELATIONSHIP
    *  setiap masing-masing buku dapat dipinjam dan dikembalikan
    */
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'id');
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'buku_id', 'id');
    }
}
