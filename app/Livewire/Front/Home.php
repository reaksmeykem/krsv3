<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.front.home')
        ->extends('master')
        ->section('content');
    }
}
