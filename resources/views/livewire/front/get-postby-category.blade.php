<div>

    <div class="py-4 flex flex-wrap items-center justify-between">
        <h2 class="text-2xl font-black text-[#2196f3]">
            {{ $category->name }}
        </h2>
        <div class="breadcrumbs text-xs">
            <ul>
              <li><a class="text-xs" href="{{ route('home') }}">Home</a></li>
              <li><a class="text-xs" href="{{ route('getPostByCategory', $category->slug) }}">{{ $category->name }}</a></li>
              {{-- <li class="text-xs">{{ $post->title }}</li> --}}
            </ul>
        </div>
    </div>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        @foreach ($posts as $post)
            @if ($post->id != 15)
            <div>
                <figure>
                    <img class="aspect-[16/9] rounded-lg bg-cover object-cover" loading="lazy" src="{{ Storage::url($post->thumbnail_path) }}"
                        alt="{{ Storage::url($post->thumbnail_path) }}" />
                </figure>
                <div>

                    <div class="mt-3">

                        <h2 class="line-clamp-2">
                            <a class="hover:text-[#2196f3] text-sm font-bold" href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <div class="mt-2 flex flex-wrap space-x-3 items-center">
                            <div><a href="{{ route('getPostByCategory', $post->category->slug) }}" class="block text-[#2196f3] font-bold"><small>{{ $post->category->name }}</small></a></div>
                            <small>{{ $post->created_at->format('F d, Y') }}</small>
                            {{-- <small class="mx-1">.</small>
                            <small>{{ $post->view_count }} Views</small> --}}
                        </div>
                        {{-- <small class="line-clamp-2 mt-2">{{ $post->excerpt }}</small> --}}
                    </div>
                </div>

            </div>
            @endif
        @endforeach
    </div>
    @if($posts->count() >= 6)
            <div class="text-center my-[60px]">
                @if($posts->hasMorePages())
                    <div role="status" wire:loading class="flex items-center">
                        <x-loading class="loading-dots text-xl text-[#2196f3]" />
                    </div>
                    <button wire:click.prevent="loadMore" wire:loading.remove>បង្ហាញបន្ថែម</button>
                @else
                    <div class="text-slate-400 dark:text-slate-700">មិនមានការប្រកាសបន្ថែមទេ</div>
                @endif
            </div>
        @endif
</div>
