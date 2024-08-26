<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use App\Models\Setting;
use Parsedown;

#[Lazy]
class Home extends Component
{
    use WithPagination;
    public $perPage = 3;

    public function loadMore(){
        $this->perPage += 3;
    }
    public function placeholder()
    {
        return <<<'HTML'
        <div class="min-h-screen font-sans antialiased">
            <div>
                <div class="my-[90px] gap-8 grid lg:grid-cols-3">
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
        sleep(2);
        // project : category id = 15


        $latestProject = Post::where('status', 1)
            ->where('category_id', 15)
            ->latest()
            ->first();

        $projects = Post::where('status', 1)
            ->where('category_id', 15)
            ->orderBy('id','desc')
            ->skip(1)
            ->latest()
            ->take(2)
            ->get();

        $posts = Post::where('status', 1)
        ->orderBy('id','desc')
        ->paginate($this->perPage);

        $settings = Setting::get();


        return view('livewire.front.home', [
            'projects' => $projects,
            'latestProject' => $latestProject,
            'posts' => $posts,
            'settings' => $settings
        ]);
    }
}
