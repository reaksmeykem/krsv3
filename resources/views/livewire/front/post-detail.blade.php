<div>
    <div class="breadcrumbs text-xs mb-4">
        <ul>
          <li><a class="text-xs" href="{{ route('home') }}">Home</a></li>
          <li><a class="text-xs" href="{{ route('getPostByCategory', $post->category->slug) }}">{{ $post->category->name }}</a></li>
          <li class="text-xs">{{ $post->title }}</li>
        </ul>
    </div>
    <div>
        <div class="mb-2">
            <a href="{{ route('getPostByCategory', $post->category->slug) }}" class="btn btn-xs btn-warning">{{ $post->category->name }}</a>
        </div>
        <div class="py-4">
            <h2 class="text-4xl text-bold">
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
        <article class="prose prose-stone my-6">
            {!! $post->body !!}
        </article>
        <div class="flex flex-wrap space-x-4 mt-8">
            @foreach($post->tags as $tag)
            <div>
                <a href="" class="btn btn-sm btn-outline">{{ $tag->name }}</a>
            </div>
            @endforeach
        </div>
     
            <script src="https://giscus.app/client.js"
                data-repo="reaksmeykem/krs.com"
                data-repo-id="R_kgDOMn8EyA"
                data-category="General"
                data-category-id="DIC_kwDOMn8EyM4Ch6Fa"
                data-mapping="pathname"
                data-strict="0"
                data-reactions-enabled="1"
                data-emit-metadata="0"
                data-input-position="bottom"
                data-theme="preferred_color_scheme"
                data-lang="en"
                data-loading="lazy"
                crossorigin="anonymous"
                async>
        </script>
    </div>
    
    <div class="my-[30px]">
        <h1 class="text-3xl mb-[30px]">Relate Posts</h1>
        <div class="grid sm:grid-cols-3 grid-cols-1 gap-8">
            @foreach ($relatePosts as $post)
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
    </div>
</div>

