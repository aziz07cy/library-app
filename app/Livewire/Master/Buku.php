<?php

namespace App\Livewire\Master;

use App\Models\Master\Buku as ModelBuku;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

class Buku extends Component
{
    use WithPagination;

    public $judul_buku;
    public $penerbit;
    public $dimensi;
    public $stock;
    public $selectedBuku;

    public function render()
    {
        return view(
            'livewire.master.buku',
            [
                'buku' => ModelBuku::latest()->paginate(10),
                'breadcrumbs' => Str::of(Request::path())->explode('/')
            ]
        );
    }

    public function save()
    {
        $this->dispatch('lounchLoading');
        try {
            $validatedData = $this->validate([
                'judul_buku' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'dimensi' => 'required|string|max:255',
                'stock' => 'required|integer'
            ]);

            if (!$this->selectedBuku) {
                ModelBuku::create($validatedData);
            } else {
                ModelBuku::find($this->selectedBuku['id'])->update($validatedData);
            }

            $this->dispatch('toast', ['', 'Buku berhasil disimpan', 'success']);
        } catch (ValidationException $e) {
            $this->dispatch(
                'invalid',
                $e->validator->errors()->toArray()
            );
        }
    }

    public function onClickRow($buku)
    {
        $this->selectedBuku = $buku;
        $this->judul_buku = $buku['judul_buku'];
        $this->penerbit = $buku['penerbit'];
        $this->dimensi = $buku['dimensi'];
        $this->stock = $buku['stock'];
    }

    public function onClickConfirm()
    {
        if ($this->selectedBuku) {
            ModelBuku::find($this->selectedBuku['id'])->delete();
            $this->dispatch('toast', ['', 'Buku berhasil dihapus', 'success']);
        }
    }

    #[On('onModalClose')]
    public function onModalClose()
    {
        $this->selectedBuku = null;
        $this->judul_buku = null;
        $this->penerbit = null;
        $this->dimensi = null;
        $this->stock = null;
    }
}
