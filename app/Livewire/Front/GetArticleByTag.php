<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Tag;
use App\Models\Post;

class GetArticleByTag extends Component
{
    public $posts;
    public $tagSlug;
    public $tagName;
    public function mount($tagSlug){
        $tag = Tag::where('slug', $tagSlug)->first();
        $this->tagName = $tag->name;
        $this->posts = $tag->posts;
    }
    public function render()
    {
        return view('livewire.front.get-article-by-tag')
        ->extends('master')
        ->section('content');;
    }
}
