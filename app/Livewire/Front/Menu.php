<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;

class Menu extends Component
{


    public function categories(){
        return Category::where('is_show', 1)->get();
    }
    public function render()
    {
        return view('livewire.front.menu', [
            'categories' => $this->categories()
        ]);
    }
}
