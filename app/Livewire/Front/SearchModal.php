<?php

namespace App\Livewire\Front;

use Livewire\Component;

class SearchModal extends Component
{
    public $editing = false;
    public $isOpen = false;


    public function openModal()
    {
        $this->isOpen = true;

    }

    public function closeModal()
    {

        $this->isOpen = false;
        $this->resetErrorBag();

    }
    public function render()
    {
        return view('livewire.front.search-modal');
    }
}
