<div class="flex flex-col gap-2 md:gap-4 lg:gap-6"
    x-data="{ 
    modalForm: false, 
    invalid: {
        invalid: '',
        judul_buku: '',
        penerbit: '',
        dimensi: '',
        stock: '',
    },
    clearInvalid(){
        this.invalid={
            invalid: '',
            judul_buku: '',
            penerbit: '',
            dimensi: '',
            stock: '',
        };
    },
    modalFormClose(){
        this.modalForm= false;
        this.clearInvalid();
        $dispatch('onModalClose')
    },
    modalConfirm: false, 
    modalConfirmClose(){
        this.modalConfirm=false;
        $dispatch('onModalClose')
    },
    modalsClose(){
        this.modalFormClose();
        this.modalConfirmClose();
        }
    }"
    @keydown.escape.window="modalsClose()"
    @toast.window="modalsClose()">
    <div class="flex flex-col">
        <div class="text-lg font-medium">
            Pengolahan Buku
        </div>
        <livewire:utils.breadcrumbs :breadcrumbs="$breadcrumbs" />
    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <button @click="modalForm=true" class="d-btn d-btn-primary w-fit">
            <flux:icon :icon="'plus'"></flux:icon>Tambah Buku
        </button>
        <table class="d-table">
            <thead>
                <tr>
                    <th class="w-10 overflow-hidden">No</th>
                    <th>Judul Buku</th>
                    <th>Penerbit</th>
                    <th>Dimensi</th>
                    <th>Stok</th>
                    <th class="w-28 overflow-hidden">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $a)
                <tr class="odd:bg-base-100 even:bg-base-200/30">
                    <td>{{$loop->index+1}}</td>
                    <td>{{$a->judul_buku}}</td>
                    <td>{{$a->penerbit}}</td>
                    <td>{{$a->dimensi}}</td>
                    <td>{{$a->stock}}</td>
                    <td>
                        <div class="flex flex-row gap-1">
                            <button wire:click="onClickRow({{$a}})" @click="modalForm=true" class="d-btn d-btn-sm d-btn-primary px-2"><flux:icon.pencil-square class="size-5" /></button>
                            <button wire:click="onClickRow({{$a}})" @click="modalConfirm=true" class="d-btn d-btn-sm d-btn-error px-2">
                                <flux:icon.trash class="size-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-base-content/60 ">-- tidak ada data buku --</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$buku->links()}}
    </div>

    <div x-show="modalForm" class="fixed top-0 left-0 z-[99] flex items-start justify-center w-screen h-screen"
        @invalid.window="
            invalid.invalid='Mohon periksa kembali input anda';
            invalid.judul_buku=$event.detail[0].judul_buku ?? $event.detail[0].judul_buku;
            invalid.tanggal_lahir=$event.detail[0].tanggal_lahir ?? $event.detail[0].tanggal_lahir"
        x-cloak>
        <div x-show="modalForm"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalFormClose()" class="absolute inset-0 w-full h-full bg-black/40"></div>
        <div x-show="modalForm"
            x-trap.inert.noscroll="modalForm"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-base-100 rounded-field p-2 md:p-4 lg:p-6 flex flex-col max-w-80 lg:max-w-5xl mt-24">

            <div class="flex items-center justify-between pb-2">
                <h3 class="text-lg font-semibold">Form Buku</h3>
                <button @click="modalFormClose()" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                    <flux:icon.x-mark />
                </button>
            </div>

            <form wire:submit.prevent="save">

                <div class="rounded-field overflow-hidden transition-all duration-500" :class="invalid.invalid ? 'h-8':'h-0'">
                    <div class="w-auto p-2 h-full bg-error/10 text-error text-sm font-medium leading-none" x-text="invalid.invalid"></div>
                </div>

                <div class="flex flex-col">
                    <div class="font-medium transition-colors duration-300" :class="invalid.judul_buku ? 'text-error':'text-base-content'">Judul Buku</div>
                    <input @input="invalid['judul_buku']='';invalid.invalid=''" type="text" wire:model="judul_buku" class="d-input">
                </div>
                <div class="flex flex-col my-2 md:my-4 lg:my-6">
                    <div class="font-medium transition-colors duration-300" :class="invalid.penerbit ? 'text-error':'text-base-content'">Penerbit</div>
                    <input @input="invalid['penerbit']='';invalid.invalid=''" type="text" wire:model="penerbit" class="d-input">
                </div>
                <div class="flex flex-col">
                    <div class="font-medium transition-colors duration-300" :class="invalid.dimensi ? 'text-error':'text-base-content'">Dimensi</div>
                    <input @input="invalid['dimensi']='';invalid.invalid=''" type="text" wire:model="dimensi" class="d-input">
                </div>
                <div class="flex flex-col my-2 md:my-4 lg:my-6">
                    <div class="font-medium transition-colors duration-300" :class="invalid.stock ? 'text-error':'text-base-content'">Stok</div>
                    <input @input="invalid['stock']='';invalid.invalid=''" type="number" wire:model="stock" class="d-input">
                </div>

                <div class="flex flex-row gap-2 mt-2">
                    <button type="submit" class="d-btn d-btn-primary">
                        <flux:icon.check />
                        Simpan
                    </button>
                    <button type="button" @click="modalFormClose()" class="d-btn">
                        <flux:icon.x-mark />
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="modalConfirm" class="fixed top-0 left-0 z-[99] flex items-start justify-center w-screen h-screen"
        @invalid.window="
            invalid.invalid='Mohon periksa kembali input anda';
            invalid.judul_buku=$event.detail[0].judul_buku ?? $event.detail[0].judul_buku;
            invalid.tanggal_lahir=$event.detail[0].tanggal_lahir ?? $event.detail[0].tanggal_lahir"
        x-cloak>
        <div x-show="modalConfirm"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalConfirmClose()" class="absolute inset-0 w-full h-full bg-black/40"></div>
        <div x-show="modalConfirm"
            x-trap.inert.noscroll="modalConfirm"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-base-100 rounded-field p-2 md:p-4 lg:p-6 flex flex-col max-w-80 lg:max-w-5xl mt-24">

            <div class="flex items-center justify-between pb-2">
                <h3 class="text-lg font-semibold">Konfirmasi</h3>
                <button @click="modalConfirmClose()" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                    <flux:icon.x-mark />
                </button>
            </div>

            <div class="">Anda akan menghapus buku <br><span class="font-medium">{{$selectedBuku ? $selectedBuku['judul_buku'] : '-- judul_buku buku --'}}</span>?</div>

            <div class="flex flex-row gap-2 mt-2 md:mt-4 lg:mt-6">
                <button wire:click="onClickConfirm" class="d-btn d-btn-primary">
                    <flux:icon.check />
                    Ya, Hapus
                </button>
                <button @click="modalConfirmClose()" class="d-btn">
                    <flux:icon.x-mark />
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>