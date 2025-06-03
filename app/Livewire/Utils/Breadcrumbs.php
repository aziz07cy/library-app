<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Breadcrumbs extends Component
{
    public $breadcrumbs;

    function mount($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function render()
    {
        return view('livewire.utils.breadcrumbs');
    }
}
