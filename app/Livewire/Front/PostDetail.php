<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostDetail extends Component
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

    public function mount($categorySlug, $postSlug){
        $category = Category::where('slug', $categorySlug)->first();
        $post = Post::where('category_id', $category->id)->where('slug', $postSlug)->first();

        // $this->seo = $post->seo;
        $post->increment('view_count');

        if($post->id == 15){
            return $this->redirect(route('about-me'), navigate:true);
        }

        $this->title = $post->title;
        $this->body = $post->body;
        $this->tags = $post->tags;
        $this->categoryName = $post->category->name;
        $this->publishedAt = \Carbon\Carbon::create($post->published_at)->format("F d, Y");
        $this->author = $post->user->name;
        $this->userAvatar = Storage::url($post->user->photo);
        $this->thumbnail = Storage::url($post->thumbnail_path);
    }



    // public function mount(Post $post){
    //     $this->title = $post->title;
    //     $this->body = $post->body;
    //     $this->tags = $post->tags;
    //     $this->categoryName = $post->category->name;
    //     $this->publishedAt = \Carbon\Carbon::create($post->published_at)->format("F d, Y");
    //     $this->author = $post->user->name;
    //     $this->userAvatar = Storage::url($post->user->photo);
    //     $this->thumbnail = Storage::url($post->thumbnail_path);
    // }

    public function render()
    {
        return view('livewire.front.post-detail')
        ->extends('master')
        ->section('content');
    }
}
