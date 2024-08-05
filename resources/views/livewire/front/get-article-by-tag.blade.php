<div>
    <div class="my-[60px] px-6 lg:px-0 min-h-screen">
        <h3 class="text-4xl font-black leading-[48px] mb-8">{{ $tagName }}</h3>
        <div>
            @foreach($posts as $article)
            <div class="mb-6 grid grid-cols-3 gap-3 border-t" style="padding-top:1.4rem; border-style:dashed;">

                <div class="col-span-2">
                    <div class="mb-2">
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate>
                            <h3 class="text-2-line text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3>
                        </a>
                        <p class="mt-3 text-2-line text-[16px] text-slate-500">{{ $article->excerpt }}</p>
                    </div>
                    <div>
                        <small class="text-slate-500">{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</small>
                    </div>

                </div>
                <div>
                    <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate>
                        <img class="w-full" style="aspect-ratio:16/9;" src="{{ Storage::url($article->thumbnail_path) }}" alt="{{ $article->thumbnail_path }}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

