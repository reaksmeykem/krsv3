<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy(isolate: true)]
class PostDetail extends Component
{
    public $post;

    public function mount($post){
        $this->post = $post;
        $this->post->increment('view_count');
    }
    public function render()
    {
        return view('livewire.front.post-detail');
    }
}
