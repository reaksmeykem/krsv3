<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;
use KhmerDateTime\KhmerDateTime;

class ArticleHomePage extends Component
{
    public $articles;
    public $projects;
    public $videos;
    public $latestArticles;
    public function mount(){
        $this->latestArticles = Post::latest()->where('id','!=',15)->take(4)->get();
        $this->articles = Post::latest()->where('category_id',16)->where('id','!=',15)->take(4)->get();
        $this->projects = Post::latest()->where('category_id',15)->take(4)->get();
        $this->videos = Post::latest()->where('category_id', 13)->take(4)->get();
    }

    public function render()
    {
        return view('livewire.front.article-home-page');
    }
}
