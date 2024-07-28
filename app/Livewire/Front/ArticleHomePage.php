<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;

class ArticleHomePage extends Component
{
    public $articles;
    public $projects;
    public $videos;
    public function mount(){
        $this->articles = Post::latest()->where('category_id',16)->where('id','!=',15)->take(5)->get();
        $this->projects = Post::latest()->where('category_id',15)->take(5)->get();
        $this->videos = Post::latest()->where('category_id', 13)->take(5)->get();
    }

    public function render()
    {
        return view('livewire.front.article-home-page');
    }
}
