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

        $anggota = Anggota::factory()->count(11)->create();
        $buku = Buku::factory()->count(11)->create();

        foreach ($anggota as $member) {
            Pengembalian::factory()->count(2)->create([
                'buku_id' => $buku->random()->id
            ]);

            Peminjaman::factory()->count(2)->create([
                'anggota_id' => $member->id,
                'buku_id' => $buku->random()->id
            ]);
        }
    }
}
