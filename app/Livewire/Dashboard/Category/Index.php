<?php

namespace App\Livewire\Dashboard\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{

    use LivewireAlert;
    public $categories;
    public $editing = false;
    public $name;
    public $slug;
    public $parent_id;
    public $state = 1;
    public $is_show = 1;
    public $description;
    public $categoryId;
    public $parent_categories;

    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function mount(){
        $this->categories = Category::latest()->get();
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


        $this->mount();
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


        $this->mount();
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
        $this->mount();
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
        return view('livewire.dashboard.category.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
