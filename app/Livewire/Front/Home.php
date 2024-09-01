<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;
// use Livewire\Attributes\Lazy;

// #[Lazy(isolate: false)]
class Home extends Component
{
    use WithPagination;
    public $perPage = 6;

    public function loadMore(){
        $this->perPage += 6;
    }
    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen font-sans antialiased">
            <div>
                <div class="my-[90px] gap-8 grid md:grid-cols-3">
                    <div class="col-span-2">
                        <div class="skeleton w-64 h-10 mb-10"></div>
                        <div class="skeleton w-full h-4 mb-3"></div>
                        <div class="skeleton w-full h-4 mb-3"></div>
                        <div class="skeleton w-full h-4 mb-10"></div>
                        <div class="skeleton w-48 h-12"></div>
                    </div>
                    <div>
                        <div class="skeleton w-full h-64"></div>
                    </div>
                </div>
                <div class="skeleton w-full h-56"></div>
            </div>
        </div>
        HTML;
    }

    public function render()
    {

        $posts = Post::where('status', 1)
        ->where('id','!=', 15)
        ->orderBy('id','desc')
        ->paginate($this->perPage);

        return view('livewire.front.home', [
            'posts' => $posts,
        ]);
    }
}
