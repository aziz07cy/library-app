<?php

namespace Database\Factories;

use App\Models\Master\Buku;
use App\Models\Transaksi\Pengembalian;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengembalian>
 */
class PengembalianFactory extends Factory
{
    protected $model = Pengembalian::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buku_id' => Buku::query()->inRandomOrder()->first()?->id, // Random existing buku or NULL
            'tanggal_kembali' => $this->faker->date('Y-m-d', Carbon::now()->subDays(rand(1, 30))),
        ];
    }
}
