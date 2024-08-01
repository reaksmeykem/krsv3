<div>

    <div class="flex justify-between items-center bg-slate-200 p-4">
        <div>
            <div>
                <a href="{{ route('dashboard') }}" wire:navigate class="text-3xl font-black">K<span class="text-[#F4CE14]">RS</span></a>
            </div>
        </div>
        <div>
            <div class="hidden lg:block">
                <ul class="flex flex-wrap justify-center space-x-7 text-slate-950">
                    @can('view dashboard')
                        <li><a href="{{ route('dashboard') }}" wire:naviate><i class="fa-solid fa-house"></i>
                                ផ្ទាំងគ្រប់គ្រង</a></li>
                    @endcan
                    @can('view user')
                        <li><a href="{{ route('user.index') }}" wire:naviate><i class="fa-solid fa-user"></i> អ្នកប្រើប្រាស់</a>
                        </li>
                    @endcan
                    @can('view role')
                        <li><a href="{{ route('role.index') }}" wire:naviate><i class="fa-solid fa-unlock-keyhole"></i>
                                មុខងារ</a></li>
                    @endcan
                    @can('view permission')
                        <li><a href="{{ route('permission.index') }}" wire:naviate><i class="fa-solid fa-key"></i>
                                ការអនុញ្ញាត</a></li>
                    @endcan
                    @can('view category')
                        <li><a href="{{ route('category.index') }}" wire:naviate><i class="fa-solid fa-layer-group"></i>
                                ប្រភេទ</a></li>
                    @endcan
                    @can('view book')
                        <li><a href="{{ route('book.index') }}" wire:naviate><i class="fa-solid fa-book"></i> សៀវភៅ</a></li>
                    @endcan
                    @can('view post')
                    <li><a href="{{ route('post.index') }}" wire:naviate><i class="fa-solid fa-newspaper"></i> ប្លុក</a></li>
                    @endcan

                    <li><a href="{{ route('tutorial.index') }}" wire:naviate><i class="fa-solid fa-newspaper"></i> ការបង្រៀន</a></li>
                </ul>
            </div>
        </div>
        <div>

            <div x-cloak x-data="{ open: false }" class="relative inline-block text-left">
                <div>
                  <button @click="open = ! open" type="button"  >
                    <div class="flex items-center">
                        <div class="me-2">
                            <p class="text-base font-semibold leading-none text-gray-900 ">
                                <a href="#">{{ Auth::user()->name }}</a>
                            </p>
                        </div>
                        <div>
                            <img class="w-12 h-12 rounded-full border"
                                src="{{ Storage::exists(Auth::user()->photo) ? Storage::url(Auth::user()->photo) : Auth::user()->photo }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                    </div>
                  </button>
                </div>
                <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2  origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" aria-orientation="vertical" tabindex="-1">
                  <div class="py-1" role="none">
                    <div class="p-5">
                        <div>
                            <label for="">ឈ្មោះអ្នកប្រើប្រាស់</label>
                            <p class="mb-4 text-sm font-semibold text-gray-900">
                                {{ Auth::user()->username != null ? '@' . Auth::user()->username : '@username' }}</p>
                        </div>
                        <div>
                            <label for="">អ៊ីម៉ែល</label>
                            <p class="mb-4 text-sm font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                        </div>
                        @livewire('logout')
                    </div>

                  </div>
                </div>
              </div>


        </div>
    </div>
    <div class="my-[20px] mx-[7px]">
        <div class="block lg:hidden">
            <ul class="flex flex-wrap justify-center space-x-7 text-slate-950">
                @can('view dashboard')
                    <li class="my-5"><a href="{{ route('dashboard') }}" wire:naviate><i class="fa-solid fa-house"></i>
                            ផ្ទាំងគ្រប់គ្រង</a></li>
                @endcan
                @can('view user')
                    <li class="my-3"><a href="{{ route('user.index') }}" wire:naviate><i class="fa-solid fa-user"></i> អ្នកប្រើប្រាស់</a>
                    </li>
                @endcan
                @can('view role')
                    <li class="my-3"><a href="{{ route('role.index') }}" wire:naviate><i class="fa-solid fa-unlock-keyhole"></i>
                            មុខងារ</a></li>
                @endcan
                @can('view permission')
                    <li class="my-3"><a href="{{ route('permission.index') }}" wire:naviate><i class="fa-solid fa-key"></i>
                            ការអនុញ្ញាត</a></li>
                @endcan
                @can('view category')
                    <li class="my-3"><a href="{{ route('category.index') }}" wire:naviate><i class="fa-solid fa-layer-group"></i>
                            ប្រភេទ</a></li>
                @endcan
                @can('view book')
                    <li class="my-3"><a href="{{ route('book.index') }}" wire:naviate><i class="fa-solid fa-book"></i> សៀវភៅ</a></li>
                @endcan
                @can('view post')
                <li class="my-3"><a href="{{ route('post.index') }}" wire:naviate><i class="fa-solid fa-newspaper"></i> ប្លុក</a></li>
                @endcan

                {{-- <li class="my-3"><a href="{{ route('tutorial.index') }}" wire:naviate><i class="fa-solid fa-newspaper"></i> ការបង្រៀន</a></li> --}}
            </ul>
        </div>
    </div>

</div>
