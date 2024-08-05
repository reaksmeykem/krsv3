<div>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Latest Updates</div>
        </div>
        <div>
            @foreach($latestArticles as $article)
                <div class="block space-y-2 md:flex mb-6">
                    <div style="width:180px;" class="mr-4">
                        <span>{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
                    </div>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
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
                <div class="block space-y-2 md:flex mb-6">
                    <div style="width:180px;" class="mr-4">
                        <span>{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
                    </div>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
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
                <div class="block space-y-2 md:flex mb-6">
                    <div style="width:180px;" class="mr-4">
                        <span>{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
                    </div>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
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
                <div class="block space-y-2 md:flex mb-6">
                    <div style="width:180px;" class="mr-4">
                        <span>{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
                    </div>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
