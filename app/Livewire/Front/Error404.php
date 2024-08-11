<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Error404 extends Component
{
    public function render()
    {
        return view('livewire.front.error404')
        ->extends('master')
        ->section('content');
    }
}
