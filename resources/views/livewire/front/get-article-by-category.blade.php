<div>
    <div class="my-[60px] px-6 lg:px-0 min-h-screen">
        <h3 class="text-4xl font-black leading-[48px] mb-8">{{ $categoryName }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            @foreach($posts as $article)
                <div>
                    <div class="mb-4">
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate>
                            <img class="w-full" style="aspect-ratio:16/9;" src="{{ Storage::url($article->thumbnail_path) }}" alt="{{ $article->thumbnail_path }}">
                        </a>
                    </div>
                    <div class="col-span-2">
                        <div>
                            <div class="half-bg">{{ $article->category->name }}</div>
                        </div>
                        <div class="my-4 mb-2">
                            <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate>
                                <h3 class="text-2-line text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3>
                            </a>
                            {{-- <p class="mt-3 text-2-line text-[16px] text-slate-500">{{ $article->excerpt }}</p> --}}
                        </div>
                        <div>
                        <small class="text-slate-500">{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
