<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleForm extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $roleModal = false;
    public bool $roleModalConfirm = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public int $roleId = 0;
    public string $name;
    public bool $editing = false;
    public $selectedPermission = [];


    public function openModal(){
        $this->resetFields();
        $this->roleModal = true;
    }

    public function closeModal(){
        $this->roleModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->name = '';
        $this->editing = false;
        $this->selectedPermission = [];
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
    ];

    public function create(){
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
        ]);

        $role->syncPermissions($this->selectedPermission);

        $this->closeModal();
        $this->resetFields();
        $this->success("Role created successfully", position: 'toast-bottom');
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
        $role = Role::find($this->roleId);
        $role->delete();
        $this->roleModalConfirm = false;
        $this->success("Role deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->roleModalConfirm = true;
        $this->roleId = $id;
    }


    public function edit($id)
    {
        $this->roleModal = true;
        $this->editing = true;
        $role = Role::find($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermission = $role->permissions->pluck('name')->toArray();
    }

    public function update(){
        $this->validate();
        $role = Role::find($this->roleId);
        $role->update([
            'name' => $this->name,
        ]);

        $role->syncPermissions($this->selectedPermission);

        $this->closeModal();
        $this->resetFields();
        $this->success('Role updated successfully.', position: 'toast-bottom');
    }
    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'permissions', 'label' => 'Permissions']
        ];
    }

    public function roles(): LengthAwarePaginator
    {

        return Role::query()
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }

    public function permissions() {
        return Permission::query()->get();
    }


    public function render()
    {
        return view('livewire.role-form', [
            'headers' => $this->headers(),
            'roles' => $this->roles(),
            'permissions' => $this->permissions()
        ]);
    }
}
