<?php

namespace App\Livewire\Master;

use App\Http\Requests\StoreAnggotaRequest;
use App\Models\Master\Anggota as ModelAnggota;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

class Anggota extends Component
{
    use WithPagination;

    public $nama;
    public $tanggal_lahir;
    public $selectedAnggota;

    public function render()
    {
        return view(
            'livewire.master.anggota',
            [
                'anggota' => ModelAnggota::latest()->paginate(10),
                'breadcrumbs' => Str::of(Request::path())->explode('/')
            ]
        );
    }

    public function save()
    {
        $this->dispatch('lounchLoading');
        try {
            $validatedData = $this->validate([
                'nama' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
            ]);

            if (!$this->selectedAnggota) {
                ModelAnggota::create($validatedData);
            } else {
                ModelAnggota::find($this->selectedAnggota['id'])->update($validatedData);
            }

            $this->dispatch('toast', ['', 'Anggota berhasil disimpan', 'success']);
        } catch (ValidationException $e) {
            $this->dispatch(
                'invalid',
                $e->validator->errors()->toArray()
            );
        }
    }

    public function onClickRow($anggota)
    {
        $this->selectedAnggota = $anggota;
        $this->nama = $anggota['nama'];
        $this->tanggal_lahir = $anggota['tanggal_lahir'];
    }

    public function onClickConfirm()
    {
        if ($this->selectedAnggota) {
            ModelAnggota::find($this->selectedAnggota['id'])->delete();
            $this->dispatch('toast', ['', 'Anggota berhasil dihapus', 'success']);
        }
    }

    #[On('onModalFormClose')]
    public function onModalFormClose()
    {
        $this->selectedAnggota = null;
        $this->nama = null;
        $this->tanggal_lahir = null;
    }

    #[On('onModalConfirmClose')]
    public function onModalConfirmClose()
    {
        $this->nama = null;
    }
}
