<div>
    <button @click="$wire.myModal1 = true">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
    </button>
    <x-modal wire:model="myModal1" class="backdrop-blur">

        <div class="mb-5 sticky top-0 p-0 m-0">
            <label class="input input-bordered flex items-center gap-2">
                <input wire:model.live="searchTerm" type="search" class="grow w-full" placeholder="Search" />
                <span class="badge badge-warning">Search</span>
            </label>
        </div>
        <div class="max-h-[400px] min-h-[400px]">
            <div class="py-6 scrollbar-custom">
                @if($results === null)
                    <p class="text-center">Please enter a keyword to begin your search.</p>
                @elseif($results->isEmpty())
                    <p class="text-center">No results found</p>
                @else
                    <div>
                        @foreach($results as $post)
                            <div class="mb-4 border-t pt-4 border-dashed">
                                <a href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                <h3 class="text-lg hover:text-warning">{{ $post->title }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center my-[60px]">
                        @if($results->hasMorePages())
                            <div role="status" wire:loading class="flex items-center">
                                <x-loading class="loading-dots text-lg text-warning" />
                            </div>
                            <button wire:click.prevent="loadMore" wire:loading.remove>Load more</button>
                        @else
                            <div class="text-slate-700 text-center">No more posts</div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </x-modal>
</div>
