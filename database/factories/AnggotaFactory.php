<?php

namespace Database\Factories;

use App\Models\Master\Anggota;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nama' => $this->faker->name(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', Carbon::now()->subYears(rand(18, 60))),
            'stock' => $this->faker->optional()->numberBetween(1, 100)
        ];
    }
}
