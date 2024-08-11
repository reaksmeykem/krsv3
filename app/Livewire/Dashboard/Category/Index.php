<?php

namespace App\Livewire\Dashboard\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Index extends Component
{

    use LivewireAlert;
    use WithPagination;
    // public $categories;
    public $editing = false;
    public $name;
    public $slug;
    public $parent_id;
    public $state = 1;
    public $is_show = 1;
    public $description;
    public $categoryId;
    public $parent_categories;
    public $perPage = 10;
    public $termSearch = '';

    public $isOpen = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function updatedPerPage($value)
    {
        $this->perPage = (int) $value; // Ensure the perPage is an integer
        $this->resetPage(); // Reset pagination to the first page
    }

    public $perPageOptions = [2, 10, 25, 50, 100];


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function mount(){

        $this->parent_categories = Category::latest()->get();
    }

    public function resetFields(){
        $this->name = '';
        $this->slug = '';
        $this->parent_id = '';
        $this->state = 1;
        $this->is_show = 1;
        $this->description = '';

        $this->editing = false;
    }

    public function save(){
        if($this->editing){
            $this->update();
        }else{
            $this->create();
        }
    }

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:categories',

    ];

    public function create(){

        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'state' => $this->state,
            'is_show' => $this->is_show,
            'description' => $this->description
        ]);


        // $this->mount();
        $this->dispatch('refresh')
            ->component('dashboard.category.index');
        $this->closeModal();
        $this->resetFields();

        $this->alert('success','Category created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

    }

    public function edit($id){


        $category = Category::find($id);


        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->parent_id = $category->parent_id;
        $this->state = $category->state;
        $this->is_show = $category->is_show;
        $this->description = $category->description;
        $this->editing = true;

        $this->openModal();



    }

    public function update(){

        $category = Category::find($this->categoryId);

        $this->slug != $category->slug ? $this->slug : $category->slug;

        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'state' => $this->state,
            'is_show' => $this->is_show,
            'description' => $this->description
        ]);


        $this->dispatch('refresh')
            ->component('dashboard.category.index');
        $this->resetFields();
        $this->closeModal();

        $this->alert('success','Category updated successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        $this->dispatch('refresh')
            ->component('dashboard.category.index');
        $this->resetFields();
        $this->alert('success','Category deleted successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function render()
    {
        $categories = Category::latest()
        ->where('name', 'like', '%' . $this->termSearch . '%')
        ->paginate($this->perPage);
        $totalCategories = Category::count();
        $countCategories = count($categories);

        return view('livewire.dashboard.category.index', [
            'categories' => $categories,
            'countCategories' => $countCategories,
            'totalCategories' => $totalCategories
        ])
        ->extends('dashboard.master')
        ->section('content');
    }
}
