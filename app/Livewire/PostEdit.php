<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostEdit extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $postModal = false;
    public bool $postModalConfirm = false;

    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];

    public $postId;
    public $title;
    public $metaTitle;
    public $metaDescription;
    public $metaKeywords;
    public $slug;
    public $description;
    public int $categoryId = 0;
    public int $status = 1;
    public int $featured = 1;
    public int $isComment = 1;
    public $ordering;
    public $published_at;
    public $thumbnail;
    public $existThumbnail;
    public $body;

    public $tagsIds = [];
    public $listTags;
    public bool $editing = false;
    public $tempUrl;
    public $thumbnailExists;


    public function updatedThumbnail()
    {
        // Get the temporary URL for preview
        $this->tempUrl = $this->thumbnail->temporaryUrl();
    }

    public function mount($id){

        $this->searchTags();

        $post = Post::find($id);

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->thumbnailExists = Storage::url($post->thumbnail_path);
        $this->body = $post->body;
        $this->description = $post->excerpt;
        $this->slug = $post->slug;
        $this->categoryId = $post->category_id;
        $this->published_at = $post->published_at;
        $this->isComment = $post->allow_comment;
        $this->featured = $post->is_featured;
        $this->status = $post->status;
        $this->ordering = $post->ordering;
        $this->metaTitle = $post->meta_title;
        $this->metaDescription = $post->meta_description;
        $this->tagsIds = $post->tags->pluck('id')->toArray();

    }

    public function resetFields(){
        $this->title = '';
        $this->slug = '';
        $this->description = '';
        $this->categoryId = 0;
        $this->status = 1;
        $this->featured = 1;
        $this->editing = false;
        $this->thumbnail = '';
        $this->tagsIds = [];
        $this->metaTitle = '';
        $this->metaDescription = '';
        $this->metaKeywords = '';
        $this->isComment = 1;
        $this->ordering = '';
        $this->published_at = '';
        $this->body = '';
        $this->thumbnailExists = '';
        $this->tempUrl = '';
    }

    function generateKhmerSlug($text) {
        $text = preg_replace('/[ \t\n\r\0\x0B]+/', ' ', $text); // Replace multiple spaces with a single space
        $text = preg_replace('/[^\p{Khmer}\s\p{L}0-9-]+/u', '', $text); // Remove all non-Khmer and non-alphanumeric characters
        $text = preg_replace('/[\s-]+/', '-', $text); // Replace spaces and consecutive hyphens with a single hyphen
        $text = strtolower(trim($text, '-')); // Trim leading and trailing hyphens

        return $text;
    }
    public function updatedTitle($value)
    {
        $this->slug = $this->generateKhmerSlug($value);
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    protected $rules = [
        'title' => 'required|max:255',
        // 'slug' => 'max:255|unique:posts,slug',
    ];

    public function update(){

        $post = Post::find($this->postId);
        $this->validate();

        if($this->thumbnail){
            if(Storage::exists($post->thumbnail_path)){
                Storage::delete($post->thumbnail_path);
            }
            $fileName = time() . '_' . $this->thumbnail->getClientOriginalName();
            $storagePath = $this->thumbnail->storeAs('public/posts/thumbnails', $fileName);
        }else{
            $storagePath = $post->thumbnail_path;
        }

        $published_at = $post->published_at;
        // $published_at = $this->published_at == null ? now()->format('Y-m-d') : $this->published_at;
        $metaTitle = $this->metaTitle == null ? $this->title : $this->metaTitle;
        $metaDescription = $this->metaDescription == null ? $this->description : $this->metaDescription;

        $post->update([
            'title' => $this->title,
            'body' => $this->body,
            'ordering' => $this->ordering,
            'category_id' => $this->categoryId,
            'user_id' => Auth::user()->id,
            'excerpt' => $this->description,
            'category_id' => $this->categoryId,
            'status' => $this->status,
            'allow_comment' => $this->isComment,
            'is_featured' => $this->featured,
            'thumbnail_path' => $storagePath,
            'published_at' => $published_at,
            'published_by' => Auth::user()->id,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $this->metaKeywords,
            // 'view_count' => 1
        ]);

        $post->tags()->sync($this->tagsIds);

        $this->redirect(route('post'), navigate: false);
        $this->resetFields();
        $this->success("Post update successfully", position: 'toast-bottom');

    }

    public function Categories(){
        return Category::query()->get();
    }

    // public function listTags(){
    //     return Tag::query()->get();
    // }




    public function searchTags(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Tag::where('id', $this->tagsIds)->get();

        $this->listTags = Tag::query()
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
    public function render()
    {
        return view('livewire.post-edit', [
            'categories' => $this->categories(),
        ]);
    }
}
