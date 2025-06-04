<div class="flex flex-col gap-2 md:gap-4 lg:gap-6">
    <div class="flex flex-col">
        <div class="text-lg font-medium">
            Transaksi Pengembalian Buku
        </div>
        <livewire:utils.breadcrumbs :breadcrumbs="$breadcrumbs" />
    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <div class="text-lg font-medium">Pengembalian Buku</div>

        <ol class="text-sm p-2 bg-base-200 rounded-field w-fit">
            <li class="font-medium">Cara melakukan pengembalian Buku:</li>
            <li>1. Cari & pilih <span class="uppercase">buku</span> dan sesuaikan dengan nama peminjamn</li>
            <li>2. Klik kembalikan buku</li>
        </ol>

        @if(!count($peminjaman))
        <div class="flex flex-row gap-2">
            <input wire:model="judulBuku" type="text" class="d-input" placeholder="Pencarian buku">
            <button wire:click="searchBuku" class="d-btn d-btn-primary">Cari Buku</button>
        </div>
        @endif

        @if(Str::length($judulBuku))
        <div class="flex flex-row flex-wrap lg:items-center">
            <div class="flex-1 flex flex-row">hasil pencarian <span class="font-medium underline">&nbsp;{{$judulBuku}}</span> </div><button wire:click="resetSearchBuku" class="d-btn d-btn-sm d-btn-error"><flux:icon.x-mark /></button>
        </div>
        <table class="d-table">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $p)
                <tr>
                    <td>{{$p->judul_buku}}</td>
                    <td>{{$p->nama_anggota}}</td>
                    <td>{{$p->tanggal_pinjam}}</td>
                    <td>
                        <button wire:click="onClickPengembalian({{$p}})" class="d-btn d-btn-sm d-btn-primary">Proses pengembalian buku</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-sm text-base-content/60">-- Pencarian tidak menemukan hasil --</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endif

    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <div class="text-lg font-medium">Data Peminjaman Buku</div>
        <table class="d-table">
            <thead>
                <tr>
                    <th class="w-10 overflow-hidden">No</th>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalian as $a)
                <tr class="odd:bg-base-100 even:bg-base-200/30">
                    <td>{{$loop->index+1}}</td>
                    <td>{{$a->judul_buku}}</td>
                    <td>{{$a->nama_anggota}}</td>
                    <td>{{$a->tanggal_pinjam}}</td>
                    <td>{{$a->tanggal_kembali}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-base-content/60 ">-- tidak ada data peminjaman --</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$pengembalian->links()}}
    </div>
</div>