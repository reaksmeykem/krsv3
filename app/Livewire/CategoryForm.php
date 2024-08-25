<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CategoryForm extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $categoryModal = false;
    public bool $categoryModalConfirm = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public int $categoryId = 0;
    public $name;
    public $slug;
    public $description;
    public int $parentId = 0;
    public int $state = 0;
    public int $isShow = 0;
    public bool $editing = false;

    public function openModal(){
        $this->resetFields();
        $this->categoryModal = true;
    }

    public function closeModal(){
        $this->categoryModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->parentId = 0;
        $this->isShow = 0;
        $this->state = 0;
        $this->editing = false;
    }

    public function updatedName($value)
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
        'name' => 'required',
        'slug' => 'required',
    ];

    public function create(){

        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'state' => $this->state,
            'is_show' => $this->isShow
        ]);


        $this->closeModal();
        $this->resetFields();
        $this->success("Category created successfully", position: 'toast-bottom');
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
        $category = Category::find($this->categoryId);
        $category->delete();
        $this->categoryModalConfirm = false;
        $this->success("Category deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->categoryModalConfirm = true;
        $this->categoryId = $id;
    }


    public function edit($id)
    {
        $this->categoryModal = true;
        $this->editing = true;
        $category = Category::find($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->state = $category->state;
        $this->isShow = $category->is_show;
        $parentId = $category->parent_id = 0 ? '': $category->parent_id;
        $this->parentId = $parentId;

    }

    public function update(){

        $category = Category::find($this->categoryId);

        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->parentId,
            'state' => $this->state,
            'is_show' => $this->isShow
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success("Category updated successfully", position: 'toast-bottom');

    }

    public function parentCategories(){
        return Category::query()->get();
    }
    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'state', 'label' => 'State', 'class' => 'w-64'],
            ['key' => 'is_show', 'label' => 'isShow?'],
            ['key' => 'parent_id', 'label' => 'Parent Id']

            // ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function categories(): LengthAwarePaginator
    {

        return Category::query()
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.category-form', [
            'categories' => $this->categories(),
            'parentCategories' => $this->parentCategories(),
            'headers' => $this->headers(),
        ]);
    }
}
