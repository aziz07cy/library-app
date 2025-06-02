<?php

namespace Database\Factories;

use App\Models\Master\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul_buku' => $this->faker->sentence(3), // Generates a random book title
            'penerbit' => $this->faker->company(), // Random publisher name
            'dimensi' => $this->faker->randomElement(['15x20 cm', '20x25 cm', '30x40 cm']), // Random dimensions
            'stock' => $this->faker->numberBetween(1, 100), // Random stock count
        ];
    }
}
