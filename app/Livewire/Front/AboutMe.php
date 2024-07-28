<?php

namespace App\Livewire\Front;

use Livewire\Component;

class AboutMe extends Component
{
    public function render()
    {
        return view('livewire.front.about-me')
        ->extends('master')
        ->section('content');
    }
}
