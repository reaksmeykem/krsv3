<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Tag;

use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;


class TagForm extends Component
{

    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $tagModal = false;
    public bool $tagModalConfirm = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public int $tagId = 0;
    public string $name;
    public string $slug;
    public bool $editing = false;


    public function openModal(){
        $this->resetFields();
        $this->tagModal = true;
    }

    public function closeModal(){
        $this->tagModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->name = '';
        $this->slug = '';
        $this->editing = false;
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:tags'
    ];

    function generateKhmerSlug($text) {
        $text = preg_replace('/[ \t\n\r\0\x0B]+/', ' ', $text); // Replace multiple spaces with a single space
        $text = preg_replace('/[^\p{Khmer}\s\p{L}0-9-]+/u', '', $text); // Remove all non-Khmer and non-alphanumeric characters
        $text = preg_replace('/[\s-]+/', '-', $text); // Replace spaces and consecutive hyphens with a single hyphen
        $text = strtolower(trim($text, '-')); // Trim leading and trailing hyphens

        return $text;
    }
    public function updatedName($value)
    {
        $this->slug = $this->generateKhmerSlug($value);
    }

    public function create(){
        $this->validate();

        Tag::create([
            'name' => $this->name,
            'slug' => $this->slug
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success("Tag created successfully", position: 'toast-bottom');
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
        // dd($this->userId);
        $tag = Tag::find($this->tagId);
        $tag->delete();
        $this->tagModalConfirm = false;
        $this->success("Tag deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->tagModalConfirm = true;
        $this->tagId = $id;
    }


    public function edit($id)
    {
        $this->tagModal = true;
        $this->editing = true;
        $tag = Tag::find($id);
        $this->tagId = $tag->id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
    }

    public function update(){
        $this->validate();
        $tag = Tag::find($this->tagId);
        $tag->update([
            'name' => $this->name,
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success('Permission updated successfully.', position: 'toast-bottom');
    }
    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'slug', 'label' => 'Slug'],
        ];
    }

    public function tags(): LengthAwarePaginator
    {

        return Tag::query()
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }



    public function render()
    {
        return view('livewire.tag-form', [
            'tags' => $this->tags(),
            'headers' => $this->headers(),
        ]);
    }
}
