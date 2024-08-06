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
                class="bg-white p-6 rounded shadow-lg z-10 m-8 w-full lg:max-w-[700px] overflow-y-auto max-h-[900px]">
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
                        <div class="mt-4">
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
                            @endif
                        </div>
                    </div>
                </div>

            </div>

    </div>
    {{-- end search form --}}
    @include('cookie-consent::index')
</div>
