<div class="py-20">
    <section class="px-6 lg:px-0">
        <div class=" mb-8">
            <div class="flex mb-6">
                <p class=" bg-[#F4CE14] px-4 rounded-full">{{ $categoryName }}</p>
            </div>
            <h3 class="text-4xl font-black leading-[48px]">{{ $title }}</h3>
            <div class="mt-6">
                <div class="flex items-center">
                    <img class="w-14 rounded-full" src="{{ $userAvatar }}" alt="">
                    <div class="ml-2">
                        <div class="font-bold">{{ $author }}</div>
                        <div><small>{{ $publishedAt }}</small></div>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="my-8">
            <img class="w-full rounded-xl shadow-md" src="{{ $thumbnail }}" alt="">
        </div> --}}
        <div class="prose prose-slate prose-xl prose-ul:list-disc prose-li">
            {!! $body !!}
        </div>
        <div class="mt-8">
            <div class="flex flex-wrap">
                @foreach($tags as $tag)
                    <div class="mr-3" style="margin-bottom:12px;">
                        <a href="{{ route('get-article-by-tag', $tag->slug) }}" class="border py-2 px-4 rounded hover:bg-[#F4CE14]">{{ $tag->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
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
    </section>
</div>
