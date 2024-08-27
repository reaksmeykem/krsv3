<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Post;

#[Lazy]
class PostDetail extends Component
{
    public $post;
    public $relatePosts;
    public $latestPosts;

    public function mount($post){
        $this->post = $post;
        $this->post->increment('view_count');

        $this->relatePosts = Post::where('status', 1)->latest()->where('category_id', $this->post->category->id)->take(4)->get();
        $this->latestPosts = Post::where('status', 1)->latest()->take(3)->get();


    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen font-sans antialiased">
            <div>
                <div class="my-[30px]">
                    <div class="skeleton w-72 h-4"></div>
                    <div class="skeleton w-28 h-4 mb-3 my-6"></div>
                    <div class="skeleton w-full h-10 mb-3"></div>
                    <div class="flex items-center my-6">
                        <div class="mr-3">
                            <div class="w-10 h-10 rounded-full skeleton"></div>
                        </div>
                        <div>
                            <div class="skeleton w-32 h-3 mb-2"></div>
                            <div class="skeleton w-28 h-3"></div>
                        </div>
                    </div>
                    <div class="skeleton w-full h-56"></div>
                </div>

            </div>
        </div>
        HTML;
    }
    public function render()
    {
        
        return view('livewire.front.post-detail');
    }
}
