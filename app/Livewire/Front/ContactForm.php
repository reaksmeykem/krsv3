<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use Mary\Traits\Toast;
// use Livewire\Attributes\Lazy;

// #[Lazy(isolate: false)]
class ContactForm extends Component
{
    use Toast;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $message;
    public $captcha;


    protected $rules = [
        'first_name' => 'required|max:100',
        'last_name' => 'required|max:100',
        'email' => 'required|email',
        'phone' => 'required|min:6|max:20',
        'message' => 'required'
    ];

    public function clearForm(){
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
    }

    // private function validateCaptcha()
    // {

    //     $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
    //         'secret' => env('HCAPTCHA_SECRET_KEY'),
    //         'response' => $this->captcha,
    //     ]);

    //     return $response->json()['success'] ?? false;

    // }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen font-sans antialiased">
            <div>
                <div class="my-[60px] gap-8 grid lg:grid-cols-1">
                    <div class="col-span-2">
                        <div class="skeleton w-64 h-10 mb-10"></div>
                        <div class="skeleton w-full h-4 mb-3"></div>
                        <div class="skeleton w-full h-4 mb-3"></div>
                        <div class="skeleton w-full h-4 mb-10"></div>
                        <div class="skeleton w-48 h-12"></div>
                    </div>

                </div>

            </div>
        </div>
        HTML;
    }

    public function store()
    {
        // Validate reCAPTCHA
        // if (!$this->validateCaptcha()) {
        //     $this->error("Google thinks you are a bot, please refresh and try again",
        //         position: 'toast-top toast-center',
        //         timeout: 5000,
        //     );
        //     // Dispatch a browser event to reset CAPTCHA
        //     $this->dispatch('reset-captcha');

        //     // session()->flash('error', "Captcha verification failed. Please refresh and try again.");
        //     return;
        // }

        $this->validate();

        Contact::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message
        ]);

        $this->clearForm();
        $this->success(
            "Thank you for your message! We’ll get back to you within 24hours",
            timeout: 5000,
            position: 'toast-top toast-center'
        );

    }


    public function render()
    {
        return view('livewire.front.contact-form');
    }
}
