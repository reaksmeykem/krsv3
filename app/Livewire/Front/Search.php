<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Search extends Component
{
    use WithPagination;
    public $searchTerm;
    public $perPage = 6;
    public bool $myModal1 = false;


    public function loadMore(){
        $this->perPage += 6;
    }

    public function render()
    {

        if(empty($this->searchTerm)) {
            $results = null;
            $this->perPage = 6;
        }else {
            $results = Post::where('title', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('body','like','%' .$this->searchTerm .'%')
            ->orWhereHas('tags', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })->paginate($this->perPage);
        }

        return view('livewire.front.search', ['results' => $results]);
    }
}
