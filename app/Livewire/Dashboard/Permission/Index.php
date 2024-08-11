<?php

namespace App\Livewire\Dashboard\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    // public $permissions;
    public $name;
    public $permissionId;
    public $editing = false;
    public $perPage = 10;
    public $termSearch = '';

    public $isOpen = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function updatedPerPage($value)
    {
        $this->perPage = (int) $value; // Ensure the perPage is an integer
        $this->resetPage(); // Reset pagination to the first page
    }

    public $perPageOptions = [10, 25, 50, 100];

    public function openModal()
    {
        $this->isOpen = true;
    }


    public function closeModal()
    {

        $this->isOpen = false;
        $this->resetForm();
        $this->resetErrorBag();

    }


    public function resetForm(){
        $this->name = '';
        $this->permissionId = null;
        $this->editing = false;
    }

    protected $rules = [
        'name' => 'required|max:225'
     ];
     public function loadMorePermissions(){
        $this->perPage += 10;
     }

    public function save()
    {

        if ($this->editing) {
            $this->update();
        } else {
            $this->create();
        }
    }
    public function create(){


        $this->validate();

        Permission::create([
            'name' => $this->name
        ]);

        // $this->mount();
        $this->dispatch('refresh')
            ->component('dashboard.permission.index');
        $this->resetForm();
        $this->closeModal();


        $this->alert('success','Permission created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function edit($id){
        $permission = Permission::find($id);
        $this->editing = true;
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->openModal();

    }

    public function update(){
        $this->validate();

        $permission = Permission::find($this->permissionId);

        $permission->update([
            'name' => $this->name
        ]);
        // $this->mount();
        $this->dispatch('refresh')
            ->component('dashboard.permission.index');
        $this->resetForm();
        $this->closeModal();


        $this->alert('success','Permission update successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function delete($id){
        Permission::find($id)->delete();
        // $this->mount();
        $this->resetForm();
        $this->dispatch('refresh')
            ->component('dashboard.permission.index');
        $this->alert('success','Permission deleted successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }

    public function render()
    {

        $totalPermissions = Permission::all()->count();
        $permissions = Permission::latest()
            ->where('name', 'like', '%' . $this->termSearch . '%')
            ->paginate($this->perPage);
        $countPermissions = count($permissions);
        return view('livewire.dashboard.permission.index', [
            'permissions' => $permissions,
            'countPermissions' => $countPermissions,
            'totalPermissions' => $totalPermissions
        ])
        ->extends('dashboard.master')
        ->section('content');
    }
}
