<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Login extends Component
{
    use LivewireAlert;
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
            $this->alert('success','You are logged in.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
            return redirect()->intended(route('dashboard'));
        }else{
            $this->resetFields();
            $this->alert('error','Invalid username or password.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
            ]);
            // session()->flash('error', 'Invalid username or password.');
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
