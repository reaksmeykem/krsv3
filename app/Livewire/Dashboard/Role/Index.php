<?php

namespace App\Livewire\Dashboard\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
class Index extends Component
{
    use LivewireAlert;
    public $roles;
    public $roleId;
    public $permissions;
    public $selectedPermission = [];
    public $name;
    public $editing = false;


    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->isOpen = false;

    }

    public function mount(){
        $this->roles = Role::latest()->get();
        $this->permissions = Permission::latest()->get();

    }

    public function search(){
        $this->roles = Role::where('name','like', '%'.$this->search.'%')->latest()->get();
    }

    public function save()
    {

        if ($this->editing) {
            $this->update();
        } else {
            $this->create();
        }
    }
    public function resetFields(){
        $this->name = '';
        $this->roleId = '';
        $this->selectedPermission = [];
        $this->editing = false;
    }
    protected $rules = [
        'name' => 'required|max:225'
    ];

    public function create(){


        $this->validate();

        $role = Role::create([
            'name' => $this->name
        ]);

        $role->syncPermissions($this->selectedPermission);

        $this->mount();
        $this->resetFields();
        $this->closeModal();

        $this->alert('success','Permission created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);


    }

    public function edit($id){
        $role = Role::find($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermission = $role->permissions->pluck('name')->toArray();
        $this->editing = true;

        $this->openModal();

    }

    public function update(){


        $role = Role::find($this->roleId);
        if($role->name == $this->name){
            $role->update([
                'name' => $role->name
            ]);
        }else{
            $role->update([
                'name' => $this->name
            ]);
        }

        $role->syncPermissions($this->selectedPermission);

        $this->mount();
        $this->resetFields();
        $this->closeModal();

        $this->alert('success','Permission updated successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

    }

    public function delete($id){
        $role = Role::find($id);
        $role->revokePermissionTo($role->permissions);
        $role->delete();
        $this->mount();
        $this->resetFields();
        $this->alert('success','Permission deleted successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }
    public function render()
    {
        return view('livewire.dashboard.role.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
