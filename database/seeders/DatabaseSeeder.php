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

        // tadinya seeder cukup ada saja, tetapi karna ada kebutuhan menampilkan chart jadi dibantu AI untuk memnuhi chart tersebut
        foreach ($anggota as $member) {
            for ($i = 0; $i < 2; $i++) {
                $tanggal_peminjaman = now()->startOfWeek()->addDays(rand(0, 6));
                $tanggal_pengembalian = $tanggal_peminjaman->copy()->addDays(rand(1, 3));

                Peminjaman::factory()->create([
                    'anggota_id' => $member->id,
                    'buku_id' => $buku->random()->id,
                    'tanggal_peminjaman' => $tanggal_peminjaman,
                ]);

                Pengembalian::factory()->create([
                    'buku_id' => $buku->random()->id,
                    'tanggal_kembali' => $tanggal_pengembalian
                ]);
            }
        }
    }
}
