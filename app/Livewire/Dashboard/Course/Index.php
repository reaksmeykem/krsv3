<?php

namespace App\Livewire\Dashboard\Course;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $editing = false;
    public $title;
    public $slug;
    public $tutorials;
    public $search = '';
    public $courseId;

    public function openModal()
    {
        $this->isOpen = true;

        // $this->emit('show-modal');
        // $this->dispatchBrowserEvent('show-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        // $this->emit('hide-modal');
        
        // $this->dispatchBrowserEvent('hide-modal');
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store(){

        $this->emit('CourseSaved');
    }
    public function render()
    {
        $courses = Course::orderBy('id','desc')->where('title', 'like', '%' . $this->search . '%')
                     ->paginate(4);
        return view('livewire.dashboard.course.index', ['courses' => $courses])
        ->extends('dashboard.master')
        ->section('content');
    }
}
