<div>
    <div class="py-20">
        <section class="md:grid md:grid-cols-3 lg:gap-6 px-6 lg:px-0">
            <div class="col-span-2">
                <h1 class="text-3xl font-black text-center md:text-start">Hi, I'm REAKSMEY</h1>
                <p class="leading-9 mt-6 text-xl text-center md:text-start">
                    I am a software developer with a passion for <span class="half-bg">technology</span> and <span class="half-bg">coding</span>. I enjoy writing about these topics and creating short videos about programming on my <span class="half-bg"><a target="_blank" href="https://www.youtube.com/@reaksmeykemofficail">YouTube</a></span> channel.
                <ul class="flex items-center justify-center md:justify-start space-x-6 mt-6">
                    <li><a target="_blank" href="https://web.facebook.com/kemreaksmeyreal"><i class="fa-brands fa-facebook text-3xl text-slate-700 hover:text-[#F4CE14]"></i></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/@reaksmeykemofficail"><i class="fa-brands fa-youtube text-3xl text-slate-700 hover:text-[#F4CE14]"></i></a></li>
                    <li><a target="_blank" href="https://github.com/reaksmeykem"><i class="fa-brands fa-github text-3xl text-slate-700 hover:text-[#F4CE14]"></i></a></li>
                </ul>
            </div>
            <div class="flex justify-center my-8 lg:my-0">
                <div>
                    <img class="w-full hover:-rotate-12 transition-transform cursor-pointer" src="{{ asset('storage/photos/13/defaultphoto/logo.png') }}" alt="">
                </div>
            </div>
        </section>
        <section class="mt-[60px]">
            <div class="my-10">
                @livewire('front.article-home-page')
            </div>
        </section>
    </div>
</div>
