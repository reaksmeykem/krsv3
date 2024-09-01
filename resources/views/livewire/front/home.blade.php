<div>
    <div class="my-[90px]">
        <section class="md:grid md:grid-cols-3 lg:gap-6 px-6 lg:px-0">
            <div class="col-span-2">
                <h1 style="line-height:62px;" class="text-4xl text-center md:text-left font-black mb-8 bg-clip-text text-transparent bg-gradient-to-r from-[#f44336] via-blue-500 to-[#2196f3]">
                    {{-- Hello, I'm Reaksmey --}}
                    សួស្តី, ខ្ញុំឈ្មោះរស្មី
                </h1>
                <p class="leading-7 text-lg text-center md:text-start">
                    ខ្ញុំជាអ្នកអភិវឌ្ឍន៍គេហទំព័រដែលមានចំណង់ចំណូលចិត្ត<span class="text-[#2196f3] font-bold"> ផ្នែកបច្ចេកវិទ្យា</span> និង<span class="text-[#2196f3] font-bold">ការសរសេរកូដ</span>។ ខ្ញុំរីករាយក្នុងការសរសេរអំពីប្រធានបទទាំងនេះ និងបង្កើតវីដេអូខ្លីៗអំពីការសរសេរកម្មវិធីនៅលើ<a class="text-[#2196f3] font-bold" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail"> YouTube</a> របស់ខ្ញុំ។
                    {{-- I am a Web Developer with a passion for <span class="text-[#f44336] font-bold">technology</span> and <span class="text-[#f44336] font-bold">coding</span>. I enjoy writing about these topics and creating short videos about programming on my <span><a class="text-[#f44336] font-bold" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail">YouTube</a></span> channel. --}}
                </p>
                <ul class="flex flex-wrap justify-start items-center gap-8 mt-6">
                    <li class="flex justify-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on facebook page" target="_blank" href="https://web.facebook.com/kemreaksmeyreal"><i class="fa-brands fa-facebook text-2xl text-slate-500 hover:text-[#2196f3]"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" aria-label="Connect with kemreaksmey on youtube" target="_blank" href="https://www.youtube.com/@reaksmeykemofficail"><i class="fa-brands fa-youtube text-2xl text-slate-500 hover:text-[#2196f3]"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-github text-2xl text-slate-500 hover:text-[#2196f3]"></i></a></li>
                    <li class="flex justify-center text-center"><a class="flex items-center" target="_blank" aria-label="Connect with kemreaksmey on github" href="https://github.com/reaksmeykem"><i class="fa-brands fa-telegram text-2xl text-slate-500 hover:text-[#2196f3]"></i></a></li>
                </ul>
                {{-- <div class="flex md:justify-start justify-center">
                    <x-button label="Learn more about me" class="btn btn-warning mt-8" link="#" />
                </div> --}}
            </div>
            <div class="flex justify-center my-8 lg:my-0">
                <div>
                    <img class="w-full hover:-rotate-12 hover:scale-90 transition-transform cursor-pointer" loading="lazy" src="{{ asset('assets/photo-homepage.webp') }}" alt="{{ asset('storage/photos/13/defaultphoto/logo.png') }}">
                </div>
            </div>
        </section>
    </div>

    <section class="my-[90px]">
        <div class="text-center md:text-left">
            <h3 class="text-3xl mb-[30px]">ប្រកាសថ្មីៗ</h3>
        </div>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
        @foreach ($posts as $post)
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
    </section>
</div>
