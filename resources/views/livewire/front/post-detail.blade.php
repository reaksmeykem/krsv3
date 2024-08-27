<div>
    <div class="breadcrumbs text-xs mb-4">
        <ul>
          <li><a class="text-xs" href="{{ route('home') }}">Home</a></li>
          <li><a class="text-xs" href="{{ route('getPostByCategory', $post->category->slug) }}">{{ $post->category->name }}</a></li>
          <li class="text-xs">{{ $post->title }}</li>
        </ul>
    </div>

        <div class="mb-2">
            <a href="{{ route('getPostByCategory', $post->category->slug) }}" class="btn btn-xs btn-warning">{{ $post->category->name }}</a>
        </div>
        <div class="py-4">
            <h2 class="text-4xl font-black">
                {{ $post->title }}
            </h2>
        </div>
        <div class="flex my-3">
            <div class="mr-3"><img class="w-12 h-12 rounded-full" src="{{ Storage::url($post->user->photo) }}" alt=""></div>
            <div>
                <div>{{ $post->user->name }}</div>
                <div><small>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</small></div>
            </div>
        </div>
        <article class="prose-stone my-6 mx-0 w-full">
            {!! $post->body !!}
        </article>
        <div class="flex flex-wrap space-x-4 mt-8">
            @foreach($post->tags as $tag)
                <div>
                    <a href="{{ route('getPostByTag', $tag->slug) }}" class="btn btn-sm btn-outline">{{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
        <script src="https://giscus.app/client.js"
            data-repo="reaksmeykem/krsv3"
            data-repo-id="R_kgDOMcKVtQ"
            data-category="kemreaksmey.com"
            data-category-id="DIC_kwDOMcKVtc4Chb8e"
            data-mapping="pathname"
            data-strict="0"
            data-reactions-enabled="1"
            data-emit-metadata="0"
            data-input-position="bottom"
            data-theme="preferred_color_scheme"
            data-lang="en"
            crossorigin="anonymous"
            async>
    </script>
    <div class="my-[30px]">
        <h1 class="text-3xl mb-[30px]">Relate Posts</h1>
        <div class="grid sm:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($relatePosts as $post)
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
    </div>

</div>

