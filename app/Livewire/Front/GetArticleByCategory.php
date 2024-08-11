<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;

class GetArticleByCategory extends Component
{
    use WithPagination;
    // public $posts;
    public $categoryName;
    public $categorySlug;
    public $perPage = 10;

    public function mount($categorySlug){
        $this->categorySlug = $categorySlug;
        $this->loadCategoryData();
    }

    public function loadCategoryData()
    {
        $category = Category::where('slug', $this->categorySlug)->first();

        if ($category) {
            $this->categoryName = $category->name;
        } else {
            $this->categoryName = 'Data not found';
        }
    }
    public function loadMorePosts(){
        $this->perPage += 10;
    }
    public function render()
    {
        $category = Category::where('slug', $this->categorySlug)->first();

        if ($category) {
            $posts = Post::where('category_id', $category->id)
                ->where('id', '!=', 15)
                ->where('status', 'published')
                ->latest()
                ->paginate($this->perPage);
        } else {
            $posts = collect(); // Empty collection if no category found
        }

        $countPosts = $posts->count();

        return view('livewire.front.get-article-by-category', [
            'posts' => $posts,
            'categoryName' => $this->categoryName,
            'countPosts' => $countPosts
        ])
        ->extends('master')
        ->section('content');
    }
}
