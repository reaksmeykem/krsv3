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

class TutorialForm extends Component
{
    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $postModal = false;
    public bool $postModalConfirm = false;

    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];

    public int $postId = 0;
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

    public function openModal(){
        $this->resetFields();
        $this->postModal = true;
    }

    public function closeModal(){
        $this->postModal = false;
        $this->resetFields();
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

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
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
        'slug' => 'required|max:255',
    ];

    public function create(){

        $this->validate();

        if($this->thumbnail){
            $fileName = time() . '_' . $this->thumbnail->getClientOriginalName();
            $storagePath = $this->thumbnail->storeAs('public/posts/thumbnails', $fileName);
        }else{
            $storagePath = null;
        }

        $published_at = $this->published_at == null ? now()->format('Y-m-d') : $this->published_at;
        $metaTitle = $this->metaTitle == null ? $this->title : $this->metaTitle;
        $metaDescription = $this->metaDescription == null ? $this->description : $this->metaDescription;

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
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
            'view_count' => 1
        ]);

        $post->tags()->sync($this->tagsIds);

        $this->closeModal();
        $this->resetFields();
        $this->success("Post created successfully", position: 'toast-bottom');
    }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete(): void
    {

        $post = Post::find($this->postId);
        if($post->thumbnail_path && Storage::exists($post->thumbnail_path)){
            Storage::delete($post->thumbnail_path);
        }
        $post->delete();
        $post->tags()->sync([]);

        $this->postModalConfirm = false;
        $this->success("Post deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->postModalConfirm = true;
        $this->postId = $id;
    }


    public function edit($id)
    {
        $post = post::find($id);
        $this->categoryId = $post->category_id;
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->description = $post->excerpt;
        $this->status = $post->status;
        $this->featured = $post->is_featured;
        $this->isComment = $post->allow_comment;
        $this->ordering = $post->ordering;
        $this->published_at = $post->published_at;
        // $this->thumbnail = Storage::url($post->thumbnail_path);
        // $this->existThumbnail = Storage::url($post->thumbnail_path);

        // $this->thumbnail = $post->thumbnail_path ? Storage::url($post->thumbnail_path) : null;
        $this->thumbnailExists = Storage::url($post->thumbnail_path);

        $this->body = $post->body;
        $this->metaTitle = $post->meta_title;
        $this->metaDescription = $post->meta_description;
        $this->metaKeywords = $post->meta_keywords;
        $this->tagsIds = $post->tags->pluck('id')->toArray();
        // $this->tagsIds = $post->tags()->sync($this->tagsIds);

    }

    public function update(){

        $post = Post::find($this->categoryId);

        $post->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'state' => $this->state,
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success("Post updated successfully", position: 'toast-bottom');

    }

    public function Categories(){
        return Category::query()->get();
    }

    // public function listTags(){
    //     return Tag::query()->get();
    // }
    public function mount()
    {
        // Fill options when component first renders
        $this->searchTags();
    }
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
    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'thumbnail_path', 'label' => 'Thumbnail', 'class' => 'w-1'],
            ['key' => 'title', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'status', 'label' => 'Status', 'class' => 'w-28'],
            ['key' => 'category_id', 'label' => 'Category', 'class' => 'w-28']

            // ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function posts(): LengthAwarePaginator
    {

        return Post::query()
            ->when($this->search, function (Builder $q) {
                $q->where('title', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(10);
    }
   

    public function render()
    {
        return view('livewire.tutorial-form', [
            'categories' => $this->categories(),
            'posts' => $this->posts(),
            'headers' => $this->headers(),
        ]);
    }
}
