<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;

class Login extends Component
{

    use Toast;
    public $email;
    public $password;
    public $remember = false;

    public function resetFields(){
        $this->email = '';
        $this->password = '';
        $this->remember = false;
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function submit(){

        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if(Auth::attempt($credentials, $this->remember)){
            $this->resetFields();
            $this->success("Successfully", position: 'toast-bottom');
            return redirect()->intended(route('dashboard'));
        }else{
            // $this->resetFields();
            $this->error("Invalid username or password.", position: 'toast-top toast-center');
            // return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
