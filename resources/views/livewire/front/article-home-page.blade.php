<div>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">Latest Updates</div>
        </div>
        <div class="space-y-6">
            @foreach($latestArticles as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-8">
                    <div class="w-[140px]">
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
        <div class="space-y-6">
            @foreach($articles as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-8">
                    <span class="w-[140px]">{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
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
        <div class="space-y-6">
            @foreach($projects as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-8">
                    <span class="w-[140px]">{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
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
        <div class="space-y-6">
            @foreach($videos as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-8">
                    <span class="w-[140px]">{{ Carbon\Carbon::create($article->published_at)->format('F d, Y')  }}</span>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
