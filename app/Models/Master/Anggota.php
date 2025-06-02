<?php

namespace App\Models\Master;

use Database\Factories\AnggotaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'anggota';

    protected $fillable = ['nama', 'tanggal_lahir'];
    
    protected static function newFactory()
    {
        return AnggotaFactory::new();
    }
}
