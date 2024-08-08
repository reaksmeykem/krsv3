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

class PostEdit extends Component
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
    public $existTags = [];

    public $post;

    public function mount(Post $post){

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->thumbnailExists = Storage::url($post->thumbnail_path);
        $this->body = $post->body;
        $this->excerpt = $post->excerpt;
        $this->slug = $post->slug;
        $this->category = $post->category_id;
        $this->published_at = $post->published_at;
        $this->allowComment = $post->allow_comment;
        $this->isFeatured = $post->is_featured;
        $this->status = $post->status;
        $this->order = $post->ordering;
        $this->metaTitle = $post->meta_title;
        $this->metaExcerpt = $post->meta_description;
        $this->existTags = $post->tags;
        $this->editing = true;

        $this->post = $post;
        $this->categories = Category::latest()->get();

    }

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

    public function removeExistTag($tagId)
    {
        $this->post->tags()->detach($tagId);
        $this->existTags = $this->post->tags; // Refresh existing tags
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
        $this->status = 'Published';
        $this->isFeatured = 1;
        $this->allowComment = 1;
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
        $this->tempUrl = null;

    }

    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:posts',
        'category' => 'required',
        'published_at' => 'required',
        'body' => 'required',
    ];


    public function update(){

        $post = Post::find($this->postId);

        $comment = ($this->allowComment == 0 || $this->allowComment == false) ? 0 : 1;

        $published_at = $this->published_at == null ? now()->format('Y-m-d') : $this->published_at;

        if($this->thumbnail){
            if(Storage::exists($post->thumbnail_path)){
                Storage::delete($post->thumbnail_path);
            }
            $fileName = time() . '_' . $this->thumbnail->getClientOriginalName();
            $storagePath = $this->thumbnail->storeAs('public/posts/thumbnails', $fileName);

        }else{
            $storagePath = $post->thumbnail_path;
        }


        $post->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'status' => $this->status,
            'published_at' => $published_at,
            'allow_comment' => $comment,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaExcerpt,
            'is_featured' => $this->isFeatured,
            'user_id' => Auth::user()->id,
            'edited_by' => Auth::user()->id,
            'thumbnail_path' => $storagePath,
            'ordering' => $this->order
        ]);

        $post->seo->update([
            'title' => $post->meta_title ? $post->meta_title : $this->title,
            'description' => $post->meta_description ? $post->meta_description : $this->excerpt,
            'author' => Auth::user()->name,
            'image' => $this->thumbnil ? Storage::url($post->thumbnail_path) : null,
            'canonical_url' => $post->slug,
         ]);


        if($this->tags != null){
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


        $this->alert('success','Post updated successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

        sleep(1);

        $this->redirect(route('post.index'), navigate: true);


    }

    public function render()
    {
        return view('livewire.dashboard.post.post-edit');
    }
}
