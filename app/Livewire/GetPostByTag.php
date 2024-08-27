<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Models\Tag;
use App\Models\Post;
#[Lazy]
class GetPostByTag extends Component
{
    public $tag;
    use WithPagination;
    public $perPage = 6;
    public function mount($tag){
        $this->tag = $tag;
    }
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
       
        $posts = $this->tag->posts;
        return view('livewire.get-post-by-tag', [
            'posts' => $posts
        ]);
    }
}
