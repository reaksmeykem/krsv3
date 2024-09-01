<?php

namespace App\Livewire;

use Livewire\Component;
// use Livewire\Attributes\Lazy;

// #[Lazy(isolate: false)]
class AboutMe extends Component
{
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
    public function render()
    {
        return view('livewire.about-me');
    }
}
