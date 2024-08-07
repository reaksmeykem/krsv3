<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;

class Navbar extends Component
{

    use WithPagination;

    public $categories;
    public $postAboutMe;

    public $editing = false;
    public $isOpen = false;

    public $searchTerm;
    public $perPage = 5;
    // public $results = null;

    // public function updatedSearchTerm()
    // {
    //     if (empty($this->searchTerm)) {
    //         $this->results = null;
    //     } else {
    //         $this->results = Post::where('title', 'like', '%' . $this->searchTerm . '%')
    //         ->orWhere('body','like','%' .$this->searchTerm .'%')
    //         ->orWhereHas('tags', function ($query) {
    //             $query->where('name', 'like', '%' . $this->searchTerm . '%');
    //         })->get();
    //     }

    // }

    public function resetSearch()
    {
        $this->searchTerm = '';
    }


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetSearch();
        $this->resetErrorBag();

    }

    public function mount(){
        $this->categories = Category::where('is_show', 1)->where('state',1)->latest()->get();
        $this->postAboutMe = Post::where('id', 15)->first();

    }

    public function loadMore(){
        $this->perPage += 5;
    }


    public function render()
    {

        if (empty($this->searchTerm)) {
            $results = null;
        } else {
            $results = Post::where('title', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('body','like','%' .$this->searchTerm .'%')
            ->orWhereHas('tags', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })->paginate($this->perPage);
        }

        return view('livewire.front.navbar', ['results' => $results]);
    }
}
