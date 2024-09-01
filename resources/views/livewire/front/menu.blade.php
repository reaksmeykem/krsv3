<div class="sticky top-0 z-50">

    <div class="bg-base-100 sticky top-0 ">
        <div class="navbar max-w-[800px] mx-auto ">

            <div class="navbar-start">
                <div class="drawer">
                    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content flex items-center">
                        <!-- Page content here -->
                        <label for="my-drawer" class="cursor-pointer drawer-button md:hidden mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h8m-8 6h16" />
                                </svg>
                        </label>
                        <div>
                            <a href="{{ route('home') }}" wire:navigate aria-label="brand name KRS" class="text-3xl font-black text-[#2196f3]">KRS</a>
                        </div>
                    </div>

                    <div class="drawer-side">
                      <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                      <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                        @foreach ($categories as $category)
                            <li><a class="text-sm" wire:navigate aria-label="{{ $category['name'] }}"
                                    href="{{ route('getPostByCategory', $category['slug']) }}">{{ $category['name'] }}</a>
                            </li>
                        @endforeach
                        <li><a class="text-sm" aria-label="Click into about me page"
                            href="{{ route('contact') }}">ទំនាក់ទំនង</a>
                        </li>
                        <li><a wire:navigate class="text-sm"
                            href="{{ route('about') }}" aria-label="About me page">អំពីខ្ញុំ</a>
                        </li>
                      </ul>
                    </div>

                </div>

            </div>

            <div class="navbar-center hidden md:flex z-50">
                <ul class="menu menu-horizontal px-1">
                    @foreach ($categories as $category)
                        <li><a class="text-sm" wire:navigate href="{{ route('getPostByCategory', $category->slug) }}" aria-label="{{ $category['name'] }}">{{ $category['name'] }}</a>
                        </li>
                    @endforeach
                    <li><a class="text-sm" aria-label="Click into about me page"
                        href="{{ route('contact') }}">ទំនាក់ទំនង</a>
                    </li>
                    <li><a class="text-sm" wire:navigate aria-label="Click into about me page"
                        href="{{ route('about') }}">អំពីខ្ញុំ</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-end">
                @livewire('front.search')
                <x-theme-toggle class="pl-3" darkTheme="dark" lightTheme="light" />
            </div>
        </div>
    </div>
</div>
