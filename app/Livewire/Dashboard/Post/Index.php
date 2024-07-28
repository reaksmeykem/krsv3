<?php

namespace App\Livewire\Dashboard\Post;

use Livewire\Component;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    public $editing = false;
    public $title;
    public $slug;
    public $body;
    public $category;
    public $published_at;
    public $status;
    public $thumbnail;
    public $banner;
    public $excerpt;
    public $postId;
    public $metaTags;
    public $metaTitle;
    public $metaExcerpt;
    public $thumbnailExists;
    public $bannerExists;
    public $allowComments;
    public $isFeatured;
    public $order;

    public $users;
    public $categories;
    public $posts;

    public $tempUrl;

    public $isOpen = false;

    public $tags = [];
    public $textInput = '';

    public $existPhoto;

    public function addTag()
    {

        $tag = trim($this->textInput);

        if ($tag && !in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
            $this->textInput = '';
        }
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function updatedThumbnail()
    {
        // Get the temporary URL for preview
        $this->tempUrl = $this->thumbnail->temporaryUrl();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function mount(){
        $this->posts = Post::latest()->get();
        $this->categories = Category::latest()->get();
    }

    public function edit($id){
        $post = Post::find($id);

        if ($post) {
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->existPhoto = Storage::url($post->thumbnail_path);
            $this->body = $post->body;
            $this->excerpt = $post->excerpt;
            $this->slug = $post->slug;
            $this->category = $post->category_id;
            $this->published_at = $post->published_at;
            $this->allowComments = $post->allow_comments;
            $this->isFeatured = $post->is_featured;
            $this->status = $post->status;
            $this->order = $post->order;
            $this->metaTitle = $post->meta_title;
            $this->metaExcerpt = $post->meta_description;
            $this->editing = true;
        }else{
            dd('Id of post not found');
        }


    }

    public function delete($id){
        $post = Post::find($id);
        if($post->thumbnail && Storage::exists($post->thumbnail)){
            Storage::delete($post->thumbnail);
        }
        $post->delete();
        $this->mount();
        $this->alert('success','Post deleted successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }



    public function render()
    {
        return view('livewire.dashboard.post.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
