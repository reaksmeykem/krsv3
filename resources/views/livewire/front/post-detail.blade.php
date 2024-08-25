<div>
    <div class="breadcrumbs text-xs mb-4">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('getPostByCategory', $post->category->slug) }}">{{ $post->category->name }}</a></li>
          <li>{{ $post->title }}</li>
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
        <figure>
            <img class="rounded-xl" src="{{ Storage::url($post->thumbnail_path) }}"
                alt="Shoes" />
        </figure>
        <article class="prose prose-stone my-6">
            {!! $post->body !!}
        </article>
        <div class="mt-8">
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
                data-theme="light"
                data-lang="en"
                crossorigin="anonymous"
                async>
            </script>
        </div>
    </div>
</div>
