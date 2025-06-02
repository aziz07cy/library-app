<?php

use App\Livewire\Master\Anggota;
use App\Livewire\Master\Buku;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Transaksi\Peminjaman;
use App\Livewire\Transaksi\Pengembalian;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('anggota', Anggota::class)->name('anggota');
    Route::get('buku', Buku::class)->name('buku');
    Route::get('peminjaman', Peminjaman::class)->name('peminjaman');
    Route::get('pengembalian', Pengembalian::class)->name('pengembalian');
});

require __DIR__.'/auth.php';
