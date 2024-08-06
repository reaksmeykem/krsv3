<?php

namespace App\Livewire\Dashboard\Tutorial;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Tutorial;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $editing = false;
    public $title;
    public $slug;
    public $tutorials;

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
        $tutorials = Tutorial::orderBy('id','desc')->paginate(10);
        return view('livewire.dashboard.tutorial.index', ['tutorials' => $tutorials])
        ->extends('dashboard.master')
        ->section('content');
    }
}
