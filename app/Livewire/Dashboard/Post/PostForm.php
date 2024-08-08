<?php

namespace App\Livewire\Dashboard\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostForm extends Component
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
    public $allowComment;
    public $isFeatured;
    public $order;

    public $users;
    public $categories;
    public $posts;

    public $tempUrl;

    public $isOpen = false;

    public $tags = [];
    public $textInput = '';

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


    public function resetFields(){

        $this->title = '';
        $this->slug = '';
        $this->category = '';
        $this->excerpt = '';
        $this->body = '';
        $this->published_at = '';
        $this->status = '';
        $this->isFeatured = 0;
        $this->allowComment = 0;
        $this->metaTitle = '';
        $this->metaTags = '';
        $this->metaExcerpt = '';
        $this->thumbnail = '';
        $this->banner = '';
        $this->order = '';
        $this->tags = [];
        $this->textInput = '';

        $this->editing = false;
        $this->thumbnailExists = '';
        $this->bannerExists = '';
        $this->tempUrl = null;

    }

    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:posts',
        'category' => 'required',
        'body' => 'required',
        'status' => 'required'
    ];

    public function mount(){

        $this->categories = Category::latest()->get();

    }

    public function save(){

        if($this->editing){
            $this->update();

            $this->alert('success','Post updated successfully', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);

        }else{
            $this->create();
            $this->resetFields();
            $this->redirect(route('post.index'), navigate: true);

            $this->alert('success','Post created successfully', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
        }
    }

    public function save_and_new(){
        $this->create();
        $this->resetFields();
        $this->alert('success','Post created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function create(){
        $this->validate();

        $comment = ($this->allowComment == 0 || $this->allowComment == false) ? 0 : 1;

        if($this->thumbnail){
            // add thumbnail
            $fileName = time() . '_' . $this->thumbnail->getClientOriginalName();
            $storagePath = $this->thumbnail->storeAs('public/posts/thumbnails', $fileName);
        }else{
            $storagePath = null;
        }
        $published_at = $this->published_at == null ? now()->format('Y-m-d') : $this->published_at;

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'status' => $this->status,
            'published_at' => $published_at,
            'allow_comment' => $comment,
            'view_count' => 1,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaExcerpt,
            'is_featured' => $this->isFeatured,
            'user_id' => Auth::user()->id,
            'published_by' => Auth::user()->id,
            'edited_by' => Auth::user()->id,
            'thumbnail_path' => $storagePath,
            'ordering' => $this->order
        ]);

        // $post->addSEO([]);
        $post->seo->update([
            'title' => $post->meta_title ? $post->meta_title : $this->title,
            'description' => $post->meta_description ? $post->meta_description : $this->excerpt,
            'author' => Auth::user()->name,
            'image' => $this->thumbnail ? Storage::url($post->thumbnail_path) : null,
            'canonical_url' => $post->slug,
         ]);

        // add tags
        $tagIds = [];
        foreach ($this->tags as $tagName) {
            $tag = Tag::firstOrCreate([
                'name' => $tagName,
                'slug' => Str::slug($tagName)
            ]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }

    public function update(){

    }

    public function render()
    {
        return view('livewire.dashboard.post.post-form')
        ->extends('dashboard.master')
        ->section('content');
    }
}
