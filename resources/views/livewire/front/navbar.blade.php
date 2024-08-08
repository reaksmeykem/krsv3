<div>
    <div class="py-5 border-b sticky top-0 backdrop-blur-2xl px-6 lg:px-0 z-40">
        <div class="flex items-center justify-between max-w-screen-md mx-auto">
            <div class="flex items-center">

                <div>
                    <a href="{{ route('home') }}" wire:navigate class="text-3xl font-black">K<span class="text-[#F4CE14]">RS</span></a>
                </div>
                <div class="mx-8 md:block hidden">
                    <ul class="flex space-x-6 navbar">
                        @foreach($categories as $category)
                            <li><a href="{{ route('get-article-by-category', $category->slug) }}" wire:navigate class="hover:rotate-6 block">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('about-me') }}" wire:navigate class="hover:rotate-6 block">About me</a></li>

                    </ul>
                </div>
            </div>
            <div class="flex items-center">
                <ul class="flex space-x-6">
                    <li>
                        <button wire:click="openModal()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </li>
                    <li><a href="#" class="bg-[#F4CE14] rounded px-4 py-2">Login</a></li>

                </ul>
                <div class="block md:hidden">
                    <div x-cloak x-data="{ open: false }" class="relative inline-block text-left">
                        <button @click="open = ! open" type="button" class="ml-[15px] border rounded px-4 py-1">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2  origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" aria-orientation="vertical" tabindex="-1">
                            <div>
                                <ul class="block space-y-6 navbar p-6 min-w-[135px]">
                                    @foreach($categories as $category)
                                        <li><a href="{{ route('get-article-by-category', $category->slug) }}" wire:navigate class="hover:rotate-6 block">{{ $category->name }}</a></li>
                                    @endforeach
                                    <li><a href="{{ route('about-me') }}" wire:navigate class="hover:rotate-6 block">About me</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- search form --}}
    <div x-cloak x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-start justify-center z-40 mx-6 lg:mx-0">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
            <div x-show="open"
                x-transition.scale
                class="bg-white p-6 rounded shadow-lg z-10 my-8 w-full lg:max-w-[700px] overflow-y-auto max-h-[900px]">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            Search
                        </div>
                        <div class="sm:flex sm:flex-row-reverse">
                            <button type="button" wire:click="closeModal()"
                                ><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="mb-5 flex">
                            <input type="text" wire:model.live="searchTerm"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg outline-none focus:ring-[#F4CE14] focus:border-[#F4CE14] block w-full p-2.5 "
                                placeholder="Enter anything..." />
                        </div>
                        <div class="my-6 max-h-96 scrollbar-custom overflow-y-scroll">
                            @if($results === null)
                                <p>Please enter a keyword to begin your search.</p>
                            @elseif($results->isEmpty())
                                <p>No results found</p>
                            @else
                                <div>
                                    @foreach($results as $article)
                                        <div class="mb-4 border-t pt-4 border-dashed">
                                            <a href="{{ route('post.detail', [$article->category->slug, $article->slug]) }}" wire:navigate>
                                            <h3 class="text-xl hover:text-[#F4CE14]">{{ $article->title }}</h3>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center my-[60px]">
                                    @if($results->hasMorePages())
                                        <span role="status" wire:loading wire:target="loadMore" class="ml-2">
                                            <svg aria-hidden="true" class="inline w-7 h-7 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </span>
                                        <button wire:click.prevent="loadMore">Load more</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

    </div>
    {{-- end search form --}}
    @include('cookie-consent::index')
</div>
