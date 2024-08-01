<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class ArticleDetail extends Component
{
    public $title;
    public $body;
    public $tags;
    public $categoryName;
    public $publishedAt;
    public $author;
    public $userAvatar;
    public $thumbnail;
    public $seo;
    public $views;
    public function mount(Post $post){
        $this->title = $post->title;
        $this->body = $post->body;
        $this->tags = $post->tags;
        $this->categoryName = $post->category->name;
        $this->publishedAt = \Carbon\Carbon::create($post->published_at)->format("F d, Y");
        $this->author = $post->user->name;
        $this->userAvatar = Storage::url($post->user->photo);
        $this->thumbnail = Storage::url($post->thumbnail_path);
        


    }
    public function render()
    {
        return view('livewire.front.article-detail');
    }
}
