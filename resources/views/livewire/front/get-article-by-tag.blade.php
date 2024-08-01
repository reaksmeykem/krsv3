<div>
    <div class="my-[60px] px-6 lg:px-0 min-h-screen">
        <h3 class="text-4xl font-black leading-[48px] mb-8">{{ $tagName }}</h3>
        <div class="space-y-6">
            @foreach($posts as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-10">
                    <span>{{ $article->published_at }}</span>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

