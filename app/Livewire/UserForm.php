<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

use Illuminate\Pagination\Paginator;

class UserForm extends Component
{

    use WithFileUploads;
    use WithPagination;
    use Toast;

    public string $search = '';

    public bool $drawer = false;
    public bool $userModal = false;
    public bool $userModalConfirm = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public int $userId = 0;
    public $photo;
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;
    public bool $editing = false;
    public string $role;
    public string $tempUrl = '';


    public function openModal(){
        $this->resetFields();
        $this->userModal = true;
    }

    public function closeModal(){
        $this->userModal = false;
        $this->resetFields();
    }

    public function resetFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->photo = '';
        $this->editing = false;
        $this->role = '';
        $this->tempUrl = '';
    }

    // Reset pagination when any component property changes
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    public function updatedPhoto()
    {
        // Get the temporary URL for preview
        $this->tempUrl = $this->photo->temporaryUrl();
    }

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required|min:6|max:32',
        'password_confirmation' => 'required|same:password'
    ];

    public function create(){

        $this->validate();
        // $photoPath = '';
        // if($this->photo){
        //     $fileName = time() . '_' . $this->photo->getClientOriginalName();
        //     $photoPath = $this->photo->storeAs('public/users', $fileName);
        // }

        $photoPath = null;
        if ($this->photo && $this->photo instanceof \Illuminate\Http\UploadedFile) {
            $fileName = time() . '_' . $this->photo->getClientOriginalName();
            $photoPath = $this->photo->storeAs('public/users', $fileName);
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' =>  Hash::make($this->password),
            'photo' => $photoPath
        ]);

        $user->syncRoles($this->role);
        $this->closeModal();
        $this->resetFields();
        $this->success("User created successfully", position: 'toast-bottom');
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
        $user = User::find($this->userId);
        if($user->photo && Storage::exists($user->photo)){
            Storage::delete($user->photo);
        }
        $user->delete();
        $this->userModalConfirm = false;
        $this->success("User deleted successfully", position: 'toast-bottom');

    }

    public function deleteConfirm($id){
        $this->userModalConfirm = true;
        $this->userId = $id;
    }


    public function edit($id)
    {
        $this->userModal = true;
        $this->editing = true;
        $user = User::find($id);
        $this->photo = Storage::url($user->photo);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name ?? '';

    }

    public function update(){

        $user = User::find($this->userId);
        $photoPath = $user->photo;

        if ($this->photo && $this->photo instanceof \Illuminate\Http\UploadedFile) {
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }
            $fileName = time() . '_' . $this->photo->getClientOriginalName();
            $photoPath = $this->photo->storeAs('public/users', $fileName);
        }


        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $photoPath
        ]);

        $user->syncRoles($this->role);

        $this->closeModal();
        $this->resetFields();
        $this->success("User updated successfully", position: 'toast-bottom');

    }
    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'photo', 'label' => 'Photo', 'class' => 'w-64'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'roles', 'label' => 'Role', 'class' => 'w-64'],
            ['key' => 'email', 'label' => 'Email'],

            // ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    public function users(): LengthAwarePaginator
    {

        return User::query()
            ->when($this->search, function (Builder $q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->orderBy($this->sortBy['column'], $this->sortBy['direction'])
            ->paginate(5);
    }

    public function roles()
    {
        return Role::query()->get(); // [id => name]
    }


    public function render()
    {
        return view('livewire.user-form', [
            'users' => $this->users(),
            'headers' => $this->headers(),
            'roles' => $this->roles()
        ]);
    }
}
