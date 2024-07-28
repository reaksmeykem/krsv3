<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{

    public function render()
    {
        return view('livewire.dashboard.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
