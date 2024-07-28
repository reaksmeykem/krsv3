<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;

class GetArticleByCategory extends Component
{
    public $posts;
    public $categoryName;
    public function mount($categorySlug){
        $category = Category::where('slug', $categorySlug)->first();
        $this->categoryName = $category->name;
        $this->posts = Post::where('category_id', $category->id)
        ->where('id','!=',15)
        ->where('status','published')
        ->latest()
        ->get();
    }
    public function render()
    {
        return view('livewire.front.get-article-by-category')
        ->extends('master')
        ->section('content');
    }
}
