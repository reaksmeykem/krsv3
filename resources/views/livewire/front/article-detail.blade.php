<div>
    {!! seo() !!}
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
        <div class="my-8">
            <img class="w-full rounded-xl shadow-md" src="{{ $thumbnail }}" alt="">
        </div>
        <div class="prose prose-slate prose-xl prose-ul:list-disc prose-li pt-8">
            {!! $body !!}
        </div>
        <div class="mt-8">
            <div class="flex flex-wrap">
                @foreach($tags as $tag)
                    <div class="mb-3 mr-3">
                        <a href="" class="border py-1 px-4 rounded-full hover:bg-[#F4CE14]">{{ $tag->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
