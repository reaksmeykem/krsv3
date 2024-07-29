<div>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">អត្ថបទ</div>
        </div>
        <div class="space-y-6">
            @foreach($articles as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-10">
                    <span>{{ $article->published_at }}</span>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="mb-[60px] px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">គម្រោង</div>
        </div>
        <div class="space-y-6">
            @foreach($projects as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-10">
                    <span>{{ $article->published_at }}</span>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="px-6 lg:px-0">
        <div class="flex justify-between items-center mb-6">
            <div class="text-3xl font-bold">វីដេអូ</div>
        </div>
        <div class="space-y-6">
            @foreach($videos as $article)
                <div class="block space-y-2 md:flex md:items-center md:space-x-10">
                    <span>{{ $article->published_at }}</span>
                    <div>
                        <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate><h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
