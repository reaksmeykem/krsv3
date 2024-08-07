<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;
use KhmerDateTime\KhmerDateTime;
use Livewire\WithPagination;

class ArticleHomePage extends Component
{
    public $articles;
    public $projects;
    public $videos;
    public $perPage = 5;


    use WithPagination;


    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $latestArticles = Post::latest()->where('id','!=',15)->paginate($this->perPage);

        return view('livewire.front.article-home-page', ['latestArticles' => $latestArticles]);
    }
}
