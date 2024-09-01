<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Category;

use Livewire\WithPagination;
use App\Models\Post;
// use Livewire\Attributes\Lazy;

// #[Lazy(isolate: false)]
class GetPostbyCategory extends Component
{
    // public $category;
    // public $posts;
    public $categorySlug;
    public function mount($categorySlug){
        $this->categorySlug = $categorySlug;
    }

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

                    <div class="card-body">
                        <div class="skeleton h-4 w-28 mb-2"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="flex space-x-3 mt-3">
                            <div class="skeleton h-3 w-24"></div>
                            <div class="skeleton h-3 w-24"></div>
                        </div>
                    </div>
                </div>
                <div class="flex w-full flex-col gap-4 card bg-base-100 ">

                    <div class="card-body">
                        <div class="skeleton h-4 w-28 mb-2"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="skeleton h-4 w-full"></div>
                        <div class="flex space-x-3 mt-3">
                            <div class="skeleton h-3 w-24"></div>
                            <div class="skeleton h-3 w-24"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }


    public function render()
    {

        $category = Category::where('slug', $this->categorySlug)->first();
        $posts = Post::where('category_id', $category->id)->latest()->with('category')->paginate($this->perPage);
        return view('livewire.front.get-postby-category', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
