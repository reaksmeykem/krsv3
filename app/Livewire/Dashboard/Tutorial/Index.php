<?php

namespace App\Livewire\Dashboard\Tutorial;

use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $isOpen = false;
    public $editing = false;
    public $title;
    public $slug;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function render()
    {
        return view('livewire.dashboard.tutorial.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
