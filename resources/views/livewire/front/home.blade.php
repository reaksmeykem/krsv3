<div>
    <div class="my-[90px]">
        <section class="md:grid md:grid-cols-3 lg:gap-6 px-6 lg:px-0">
            <div class="col-span-2">
                <h1 class="text-4xl text-center md:text-left font-black mb-8">
                    Hello, I'm Reaksmey
                </h1>
                <p class="leading-7 text-md text-center md:text-start">
                    I am a Web Developer with a passion for <span class="text-warning">technology</span> and <span class="text-warning">coding</span>. I enjoy writing about these topics and creating short videos about programming on my <span><a class="text-warning" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail">YouTube</a></span> channel.
                </p>
                <ul class="flex flex-wrap justify-start items-center gap-8 mt-6">
                    <li class="flex justify-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on facebook page" target="_blank" href="https://web.facebook.com/kemreaksmeyreal"><i class="fa-brands fa-facebook text-2xl text-slate-500 hover:text-warning"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on youtube" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail"><i class="fa-brands fa-youtube text-2xl text-slate-500 hover:text-warning"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-github text-2xl text-slate-500 hover:text-warning"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-telegram text-2xl text-slate-500 hover:text-warning"></i></a></li>
                </ul>
                {{-- <div class="flex md:justify-start justify-center">
                    <x-button label="Learn more about me" class="btn btn-warning mt-8" link="#" />
                </div> --}}
            </div>
            <div class="flex justify-center my-8 lg:my-0">
                <div>
                    <img class="w-full hover:-rotate-12 transition-transform cursor-pointer" loading="lazy" src="{{ asset('storage/photos/13/defaultphoto/logo.png') }}" alt="{{ asset('storage/photos/13/defaultphoto/logo.png') }}">
                </div>
            </div>
        </section>
    </div>

    <section class="my-[90px]">
        <div class="text-center sm:text-left">
            <h3 class="text-3xl mb-[30px]">My Latest Post</h3>
        </div>

    <div class="grid sm:grid-cols-2 grid-cols-1 gap-6">
        @foreach ($posts as $post)

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
