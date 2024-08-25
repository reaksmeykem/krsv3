<div>
    <div class="grid sm:grid-cols-2 grid-cols-1 sm:gap-8">
        @foreach ($posts as $post)
            @if ($post->id != 15)
                <div class="card bg-base-100 shadow-sm">
                    <figure>
                        <img src="{{ Storage::url($post->thumbnail_path) }}"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <div class="mb-2">
                            <a href="" class="btn btn-xs btn-warning">{{ $post->category->name }}</a>
                        </div>
                        <div class="line-clamp-2 card-title">
                            <a href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                <h2>
                                    {{ $post->title }}
                                </h2>
                            </a>
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
