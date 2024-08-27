<div>

    <div class="py-4 flex flex-wrap items-center justify-between">
        <h2 class="text-2xl font-black">
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
    <div class="grid sm:grid-cols-2 grid-cols-1 sm:gap-6">
        @foreach ($posts as $post)
            @if ($post->id != 15)
            <div class="card bg-base-100 shadow">
                {{-- <figure>
                    <img loading="lazy" src="{{ Storage::url($post->thumbnail_path) }}"
                        alt="{{ Storage::url($post->thumbnail_path) }}" />
                </figure> --}}
                <div class="card-body">

                    <div>
                        <div><a href="{{ route('getPostByCategory', $post->category->slug) }}" class="block text-warning"><small>{{ $post->category->name }}</small></a></div>
                        <h2 class="line-clamp-2">
                            <a class="hover:text-warning text-lg font-bold" href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <div class="mt-2 flex flex-wrap space-x-3 items-center">

                            <small>{{ $post->created_at->format('F d, Y') }}</small>
                            <small class="mx-1">.</small>
                            <small>{{ $post->view_count }} Views</small>
                        </div>
                        {{-- <p class="line-clamp-2 mt-2">{{ $post->excerpt }}</p> --}}
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
                        <x-loading class="loading-dots text-lg text-warning" />
                    </div>
                    <button wire:click.prevent="loadMore" wire:loading.remove>Load more</button>
                @else
                    <div class="text-slate-700">No more posts</div>
                @endif
            </div>
        @endif
</div>
