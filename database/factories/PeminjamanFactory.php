<?php

namespace Database\Factories;

use App\Models\Master\Anggota;
use App\Models\Master\Buku;
use App\Models\Transaksi\Peminjaman;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    protected $model = Peminjaman::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'anggota_id' => Anggota::query()->inRandomOrder()->first()?->id, // Random existing anggota or NULL
            'buku_id' => Buku::query()->inRandomOrder()->first()?->id, // Random existing buku or NULL
            'tanggal_peminjaman' => $this->faker->date('Y-m-d', Carbon::now()->subDays(rand(1, 30))),
        ];
    }
}
