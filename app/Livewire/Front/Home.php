<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;

#[Lazy(isolate: true)]
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
            <div class="gap-4 grid sm:grid-cols-2">
                <div class="flex w-full flex-col gap-4 card bg-base-100 ">
                    <div class="skeleton h-48 w-full rounded-b-none"></div>
                    <div class="card-body">
                        <div class="skeleton h-4 w-28 mb-2"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="skeleton h-4 w-full"></div>
                    </div>
                </div>
                <div class="flex w-full flex-col gap-4 card bg-base-100 ">
                    <div class="skeleton h-48 w-full rounded-b-none"></div>
                    <div class="card-body">
                        <div class="skeleton h-4 w-28 mb-2"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="skeleton h-4 w-full"></div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function render()
    {
        sleep(2);
        $posts = Post::where('status', 1)->paginate($this->perPage);
        return view('livewire.front.home', ['posts' => $posts]);
    }
}
