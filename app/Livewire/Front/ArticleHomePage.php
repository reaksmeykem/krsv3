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
    public $perPage = 10;

    use WithPagination;


    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $latestArticles = Post::latest()->where('id','!=',15)->paginate($this->perPage);
        $countPosts = count($latestArticles);

        return view('livewire.front.article-home-page', [
            'latestArticles' => $latestArticles,
            'countPosts' => $countPosts
        ]);
    }
}
