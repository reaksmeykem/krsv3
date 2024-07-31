<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Index extends Component
{

    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;

    public $editing = false;
    public $name;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $userId;
    public $photo;
    public $existPhoto;

    public $new_password;
    public $confirm_new_password;
    public $current_password;

    public $users;
    public $roles;
    public $role;
    public $userRole;
    public $tempUrl;

    public $passwordDisabled = false;


    public $isOpen = false;
    public $showChangePasswordModal = false;

    public function openModal()
    {
        $this->isOpen = true;

    }

    public function closeModal()
    {

        $this->isOpen = false;
        $this->resetFields();
    }

    public function openChangePasswordModal(){
        $this->showChangePasswordModal = true;
    }
    public function closeChangePasswordModal(){
        $this->new_password = '';
        $this->confirm_new_password = '';
        $this->current_password = '';
        $this->showChangePasswordModal = false;
    }
    public function mount(){
        $this->users = User::latest()->get();
        $this->roles = Role::latest()->get();

    }

    public function resetFields(){
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->photo = '';
        $this->existPhoto = null;
        $this->userId = null;
        $this->editing = false;
        $this->confirm_password = '';
        $this->passwordDisabled = false;
        $this->role = null;
        $this->tempUrl = null;

    }

    public function updatedPhoto()
    {
        // Get the temporary URL for preview
        $this->tempUrl = $this->photo->temporaryUrl();
    }

    protected $rules = [
        'name' => 'required',
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
        'role' => 'required'
    ];
    public function create(){

        $this->validate();

        if($this->photo){
            // $photoUserPath = $this->photo ? $this->photo->store('users', 's3') : null;
            $fileName = time() . '_' . $this->photo->getClientOriginalName();
            $storagePath = $this->photo->storeAs('public/users', $fileName);
        }

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'photo' => $storagePath,
        ]);

        $user->syncRoles($this->role);

        $this->mount();
        $this->resetFields();
        $this->closeModal();
        return redirect(request()->header('Referer'));

        $this->alert('success','User created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

    }

    public function save()
    {
        if ($this->editing) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function changePassword($id){
        $user = User::find($id);
        $this->userId = $user->id;
        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_new_password = '';
        $this->openChangePasswordModal();

    }

    public function resetPassword(){

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ]);


        $user = User::find($this->userId);


         // Check if the current password matches
        if (!Hash::check($this->current_password, $user->password)) {
            $this->alert('error','The current password is incorrect.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_new_password = '';
        $this->closeChangePasswordModal();
        return redirect(request()->header('Referer'));

        $this->alert('success','The password reset successfully.', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);

    }

    public function edit($id){
        $this->resetFields();

        $user = User::find($id);
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        // $this->photo = $user->photo;
        // if ($user->photo && Storage::disk('s3')->exists($user->photo)) {
        //     $this->existPhoto = Storage::disk('s3')->url($user->photo);
        // } else {
        //     $this->existPhoto = null;
        // }
        if(Storage::exists($user->photo)){
            $this->existPhoto = Storage::url($user->photo);
        }else{
            $this->existPhoto = null;
        }

        $this->userId = $user->id;

        $this->role = $user->roles->first()->name ?? ''; // Assuming user has at least one role
        $this->userRole = $this->role; // Store the user's current role for comparison in the template
        $this->passwordDisabled = true;
        $this->editing = true;

        $this->openModal();
    }

    public function update(){
try{

        $user = User::find($this->userId);

        if ($this->photo) {

            if( $user->photo && Storage::exists($user->photo)){
                $this->existPhoto = Storage::delete($user->photo);
            }

            $fileName = time() . '_' . $this->photo->getClientOriginalName();
            $storagePath = $this->photo->storeAs('public/users', $fileName);


        }else{

            $storagePath = $user->photo;
        }

        $user->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'photo' => $storagePath,
        ]);

        $user->syncRoles($this->role);

        $this->mount();
        $this->resetFields();
        $this->closeModal();
        return redirect(request()->header('Referer'));

        $this->alert('success','User created successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);


    } catch (QueryException $e) {
        // Check if the exception is a duplicate entry error
        if ($e->errorInfo[1] == 1062) {
            $this->alert('error', 'Duplicate email entry detected. Please use a different email.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
        } else {
            // Handle other possible exceptions
            $this->alert('error', 'An error occurred while updating the user. Please try again.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
        }
    }

    }

    public function delete($id){
        $user = User::find($id);
        if($user->photo && Storage::exists($user->photo)){
            Storage::delete($user->photo);
        }
        $user->delete();
        $this->mount();
        $this->resetFields();
        return redirect(request()->header('Referer'));
        $this->alert('success','User deleted successfully', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
        ]);
    }




    public function render()
    {

        return view('livewire.dashboard.user.index')
        ->extends('dashboard.master')
        ->section('content');
    }
}
