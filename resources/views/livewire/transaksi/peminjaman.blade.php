<div class="flex flex-col gap-2 md:gap-4 lg:gap-6">
    <div class="flex flex-col">
        <div class="text-lg font-medium">
            Transaksi Peminjaman Buku
        </div>
        <livewire:utils.breadcrumbs :breadcrumbs="$breadcrumbs" />
    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <div class="text-lg font-medium">Peminjaman Buku</div>

        <ol class="text-sm p-2 bg-base-200 rounded-field w-fit">
            <li class="font-medium">Cara melakukan peminjaman Buku:</li>
            <li>1. Cari & pilih <span class="uppercase">anggota</span></li>
            <li>2. Caria & pilih <span class="uppercase">buku</span></li>
            <li>3. Simpan data peminjaman</li>
        </ol>

        @if(!$selectedAnggota)
        <div class="flex flex-row gap-2">
            <input wire:model="namaAnggota" type="text" class="d-input" placeholder="Pencarian anggota">
            <button wire:click="searchAnggota" class="d-btn d-btn-primary">Cari Anggota</button>
        </div>
        @else
        <div class="flex flex-row flex-wrap gap-2 items-center border p-4 rounded-field border-base-content/30">
            <div class="flex flex-col">
                <span>Anggota : </span>
                <div class="p-2 bg-base-200 rounded-field flex flex-row items-center gap-2">
                    <flux:icon.user />
                    {{$selectedAnggota['nama']}}
                </div>
            </div>
            <div class="flex flex-col">
                <span>Buku : </span>
                <div class="p-2 bg-base-200 rounded-field flex flex-row items-center gap-2">
                    <flux:icon.rectangle-stack />
                    @if($selectedBuku)
                    {{$selectedBuku['judul_buku']}}
                    @else
                    <span class="text-base-content/60">-- silakan pilih buku --</span>
                    @endif
                </div>
            </div>
            @if($selectedAnggota && $selectedBuku)
            <button wire:click="onClickSimpanPeminjaman" class="d-btn d-btn-primary self-end">
                <flux:icon.check />
                Simpan peminjaman
            </button>
            @else
            <button class="d-btn d-btn-primary d-btn-disabled self-end" disabled>
                <flux:icon.check />
                Simpan peminjaman
            </button>
            @endif
            <button wire:click="onClickResetPeminjaman" class="d-btn d-btn-error self-end">
                <flux:icon.x-mark />
                Reset
            </button>
        </div>
        @endif
        @if($selectedAnggota && !$selectedBuku)
        <div class="flex flex-row gap-2">
            <input wire:model="judulBuku" type="text" class="d-input" placeholder="Pencarian buku">
            <button wire:click="searchBuku" class="d-btn d-btn-primary">Cari Buku</button>
        </div>
        @endif

        <!-- list hasil pencarian anggota -->
        <div class="w-fit flex flex-col transition-all duration-200 {{count($anggota) ? 'h-32 overflow-auto':'h-0 overflow-hidden'}}">
            @if($namaAnggota)
            <span class=" text-sm text-base-content/60 mb-2">-- Hasil pencarian "<span class="font-medium">{{$namaAnggota}}</span>" :</span>
            @endif
            @forelse($anggota as $a)
            <button wire:click="onClickAnggota({{$a}})" class="d-btn d-btn-sm d-btn-soft text-sm font-normal">
                <flux:icon.user />
                {{$a->nama}}
            </button>
            @empty
            -- tidak menemukan hasil --
            @endforelse
        </div>

        <!-- list hasil pencarian buku -->
        <div class="w-fit flex flex-col transition-all duration-200 {{count($buku) ? 'h-32 overflow-auto':'h-0 overflow-hidden'}}">
            @if($judulBuku)
            <span class=" text-sm text-base-content/60 mb-2">-- Hasil pencarian "<span class="font-medium">{{$judulBuku}}</span>" :</span>
            @endif
            @forelse($buku as $a)
            @if($a->stock != 0)
            <button wire:click="onClickBuku({{$a}})" class="d-btn d-btn-sm d-btn-soft text-sm font-normal">
                <flux:icon.rectangle-stack />
                {{$a->judul_buku}}
            </button>
            @else
            <span class="text-base-content/60">
                <flux:icon.rectangle-stack />
                {{$a->judul_buku}} (Stok buku tidak tersedia)
            </span>
            @endif
            @empty
            -- tidak menemukan hasil --
            @endforelse
        </div>

    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <div class="text-lg font-medium">Data Peminjaman Buku</div>
        <table class="d-table">
            <thead>
                <tr>
                    <th class="w-10 overflow-hidden">No</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Anggota</th>
                    <th>Buku yang dipinjam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $a)
                <tr class="odd:bg-base-100 even:bg-base-200/30">
                    <td>{{$loop->index+1}}</td>
                    <td>{{$a->tanggal_peminjaman}}</td>
                    <td>{{$a->anggota->nama}}</td>
                    <td>{{$a->buku->judul_buku}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-base-content/60 ">-- tidak ada data peminjaman --</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$peminjaman->links()}}
    </div>
</div>