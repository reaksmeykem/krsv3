<div>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Latest Updates</div>
        </div>
        <div>
            @foreach($latestArticles as $article)
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
    </section>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Articles</div>
        </div>
        <div>
            @foreach($articles as $article)
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
    </section>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Projects</div>
        </div>
        <div>
            @foreach($projects as $article)
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
    </section>
    <section class="px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Videos</div>
        </div>
        <div>
            @foreach($videos as $article)
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
    </section>
</div>
