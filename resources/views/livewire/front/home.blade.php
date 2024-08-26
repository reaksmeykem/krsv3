<div>
    <div class="my-[90px]">
        <section class="md:grid md:grid-cols-3 lg:gap-6 px-6 lg:px-0">
            <div class="col-span-2">
                <h1 class="text-4xl prose text-center md:text-left font-black mb-8">
                    Hello, I'm Reaksmey
                </h1>
                <p class="leading-7 text-md text-center md:text-start">
                    I am a Web Developer with a passion for <span class="text-warning">technology</span> and <span class="text-warning">coding</span>. I enjoy writing about these topics and creating short videos about programming on my <span><a class="text-warning" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail">YouTube</a></span> channel.
                </p>
                <div class="flex md:justify-start justify-center">
                    <x-button label="Learn more about me" class="btn btn-warning mt-8" link="#" />
                </div>
            </div>
            <div class="flex justify-center my-8 lg:my-0">
                <div>
                    <img class="w-full hover:-rotate-12 transition-transform cursor-pointer" src="{{ asset('storage/photos/13/defaultphoto/logo.png') }}" alt="">
                </div>
            </div>
        </section>
    </div>
    <section class="card bg-base-100 shadow p-[30px]">
        <div class="card-body">
            <h3 class="text-3xl">Find me online and connect</h3>
            <ul class="flex flex-wrap justify-start items-center gap-8 mt-6">
                <li class="flex justify-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on facebook page" target="_blank" href="https://web.facebook.com/kemreaksmeyreal"><i class="fa-brands fa-facebook text-3xl text-slate-500 hover:text-warning mr-3"></i> Facebook</a></li>
                <li class="flex justify-center text-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on youtube" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail"><i class="fa-brands fa-youtube text-3xl text-slate-500 hover:text-warning mr-3"></i> YouTube</a></li>
                <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-github text-3xl text-slate-500 hover:text-warning mr-3"></i> GitHub</a></li>
                <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-telegram text-3xl text-slate-500 hover:text-warning mr-3"></i> Telegram</a></li>
            </ul>
        </div>
    </section>
    <section class="my-[90px]">
        <div class="mb-[30px]">
            <h3 class="text-3xl text-center sm:text-start">See My Work</h3>
        </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow col-span-2">
                    <figure>
                        <img src="{{ Storage::url($latestProject->thumbnail_path) }}"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <div class="mb-2">
                            <a href="" class="btn btn-xs btn-warning">{{ $latestProject->category->name }}</a>
                        </div>
                        <div class="line-clamp-2 card-title">
                            <a class="hover:text-warning" href="{{ route('postDetail', [$latestProject->category->slug, $latestProject->slug]) }}">
                                <h2 class="text-xl">
                                    {{ $latestProject->title }}
                                </h2>
                            </a>
                            {{-- <p class="line-clamp-2 text-md mt-3">{{ $latestProject->excerpt }}</p> --}}
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    @foreach ($projects as $post)

                            <div class="card bg-base-100 shadow">
                                <figure>
                                    <img src="{{ Storage::url($post->thumbnail_path) }}"
                                        alt="{{ $post->thumbnail_path }}" />
                                </figure>
                                <div class="card-body">
                                    <div class="line-clamp-3">
                                        <a class="hover:text-warning" href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                            <h2 class="text-lg">
                                                {{ $post->title }}
                                            </h2>
                                        </a>
                                    </div>
                                </div>
                            </div>

                    @endforeach
                </div>
        </div>
    </section>
    <section class="card bg-base-100 shadow p-[30px]">
        <div class="card-body">
            <h3 class="text-3xl">Technology We Use</h3>
            <ul class="flex flex-wrap justify-start items-center gap-8">
                <li><a class="flex items-center" aria-label="Connect with kemreaksmey on facebook page" target="_blank">
                    <img class="w-12 mr-3" src="{{ asset('storage/photos/13/defaultphoto/icons/Tailwind.png') }}" alt="">
                    Tailwind CSS</a></li>
                <li><a class="flex items-center" aria-label="Connect with kemreaksmey on youtube" target="_blank">
                    <img class="w-16 mr-3" src="{{ asset('storage/photos/13/defaultphoto/icons/Alpine.js.png') }}" alt="">
                    AlpineJS</a></li>
                <li><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github">
                    <img class="w-10 mr-3" src="{{ asset('storage/photos/13/defaultphoto/icons/Livewire.png') }}" alt="">
                    Livewire</a></li>
                <li><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github">
                    <img class="w-10 mr-3" src="{{ asset('storage/photos/13/defaultphoto/icons/Laravel.png') }}" alt="">
                    Laravel</a></li>
            </ul>
        </div>
    </section>
    <section class="my-[90px]">
        <div class="text-center">
            <h3 class="text-3xl mb-[30px]">My Latest Post</h3>
        </div>

    <div class="grid sm:grid-cols-3 grid-cols-1 gap-8">
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
                            <a class="hover:text-warning" href="{{ route('postDetail', [$post->category->slug, $post->slug]) }}">
                                <h2 class="text-lg">
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
    </section>
</div>
