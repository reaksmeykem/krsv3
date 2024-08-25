<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;
use Spatie\Permission\Models\Permission;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PermissionForm extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $permissionModal = false;
    public bool $permissionModalConfirm = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public int $permissionId = 0;
    public string $name;
    public bool $editing = false;


    public function openModal(){
        $this->resetFields();
        $this->permissionModal = true;
    }

    public function closeModal(){
        $this->permissionModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->name = '';
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
    ];

    public function create(){
        $this->validate();

        Permission::create([
            'name' => $this->name,
        ]);

        $this->closeModal();
        $this->resetFields();
        $this->success("Permission created successfully", position: 'toast-bottom');
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
        $permission = Permission::find($this->permissionId);
        $permission->delete();
        $this->permissionModalConfirm = false;
        $this->success("Permission deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->permissionModalConfirm = true;
        $this->permissionId = $id;
    }


    public function edit($id)
    {
        $this->permissionModal = true;
        $this->editing = true;
        $permission = Permission::find($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
    }

    public function update(){
        $this->validate();
        $permission = Permission::find($this->permissionId);
        $permission->update([
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
        ];
    }

    public function permissions(): LengthAwarePaginator
    {

        return Permission::query()
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }


    public function render()
    {
        return view('livewire.permission-form', [
            'permissions' => $this->permissions(),
            'headers' => $this->headers(),
        ]);
    }
}
