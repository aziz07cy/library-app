<?php

namespace Database\Seeders;

use App\Models\Master\Anggota;
use App\Models\Master\Buku;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\Pengembalian;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Buku::factory()
            ->count(50)
            ->has(Pengembalian::factory()->count(3))
            ->has(Peminjaman::factory()->count(4)->for(Anggota::factory()->create()))
            ->create();
    }
}
