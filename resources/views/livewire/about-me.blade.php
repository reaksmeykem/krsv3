<div class="mb-[60px]">
    <div class="pt-4 flex flex-wrap items-center justify-between">
        <h2 class="text-2xl font-black text-[#2196f3]">
            {{-- About Me --}}
            អំពីខ្ញុំ
        </h2>
        <div class="breadcrumbs text-xs">
            <ul>
                <li><a class="text-xs" href="{{ route('home') }}">ទំព័រដើម</a></li>
                <li class="text-xs">អំពីខ្ញុំ</li>
            </ul>
        </div>
    </div>

    <article class=" my-6 mx-0 w-full">

        <div>
            <p>ខ្ញុំជាអ្នកអភិវឌ្ឍគេហទំព័រដែលមានមូលដ្ឋាននៅភ្នំពេញ។ ខ្ញុំបានអភិវឌ្ឍគេហទំព័រចាប់តាំងពីឆ្នាំ ២០១៨ ប៉ុន្តែដំណើរទៅនឹងបច្ចេកវិទ្យារបស់ខ្ញុំបានចាប់ផ្តើមមុនពេលនោះ។ ខ្ញុំមានចំណាប់អារម្មណ៍យ៉ាងខ្លាំងលើបច្ចេកវិទ្យា ហើយបានចំណាយពេលជាច្រើនក្នុងការសិក្សាភាសាកម្មវិធី និងឧបករណ៍ថ្មីៗ។
            </p>
            {{-- <p>I am a web developer based in Phnom Penh, Cambodia. I have been developing websites professionally since 2018, but my journey with technology began much earlier, experimenting with graphic design and web development during my school years. I have always been passionate about technology, spending countless hours learning new programming languages and tools.</p> --}}
            <p class="mt-3">ក្រៅពីការងារ ខ្ញុំរីករាយក្នុងការចូលរួមការងារស្ម័គ្រចិត្ត ការស្រាវជ្រាវបច្ចេកវិទ្យាថ្មីៗ និងការរៀនអំពីទីផ្សារឌីជីថល។</p>
        </div>

        <div>
            <div class="my-6 ">
                <img class="aspect-[16/9] w-full overflow-y-hidden rounded-lg object-cover bg-cover bg-end object-right" src="{{ asset('storage/photos/13/defaultphoto/reaksmey_kem.jpg') }}" alt="">
            </div>
        </div>


        <h2 class="text-xl font-black my-6 text-[#2196f3]">
            បទពិសោធន៍ការងារ
        </h2>
        <ul class="timeline timeline-snap-icon timeline-compact timeline-vertical">
            <li>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end mb-10">
                    <time class="font-mono italic">ខែកញ្ញា ឆ្នាំ២០២៣ - បច្ចុប្បន្ន</time>
                    <div class="text-lg font-black py-1">Aii Language Center </div>
                    <p class="font-bold text-[#2196f3]">Web Developer</p>
                    <p class="mt-3">បានបង្កើត និងថែទាំគេហទំព័ររបស់សាលា ដើម្បីធ្វើឲ្យវាមានសភាពទាន់សម័យ មានភាពងាយស្រួលសម្រាប់អ្នកប្រើប្រាស់ និងគាំទ្រប្រសើរចំពោះការទំនាក់ទំនង និងតម្រូវការប្រតិបត្តិការរបស់សាលា។</p>
                    {{-- <p class="mt-3">Built and maintained the school's website, ensuring it is up-to-date, user-friendly, and effectively supports the center's communication and operational needs.</p> --}}
                </div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end mb-10">
                    <time class="font-mono italic">ខែតុលា ឆ្នាំ២០២១ - ខែមេសា ឆ្នាំ២០២៣</time>
                    <div class="text-lg font-black py-1">Young Development Research & Consulting Co., Ltd</div>
                    <p class="font-bold text-[#2196f3]">ITC Officer and Web developer</p>
                    <p class="mt-3">បានអភិវឌ្ឍនិងគ្រប់គ្រងគេហទំព័រជាច្រើន រួមមានគេហទំព័រ​សម្រាប់វិស័យកសិកម្ម ព័ត៌មាន និងក្រុមហ៊ុន ដើម្បីបង្កើនវត្តមានអនឡាញ និងការបញ្ជូនព័ត៌មានរបស់អង្គភាព។</p>
                    {{-- <p class="mt-3">Developed and managed various websites, including those for agriculture, news, and the company, enhancing the organization's online presence and information dissemination.</p> --}}
                </div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end mb-10">
                    <time class="font-mono italic">May 2020 - August 2021</time>
                    <div class="text-lg font-black py-1">Supreme Realtor Property Co., Ltd</div>
                    <p class="font-bold text-[#2196f3]">Graphic Designer & Facebook Ads</p>
                    <p class="mt-3">គ្រប់គ្រង និងBoostទំព័រ Facebook របស់ក្រុមហ៊ុន និងរចនា Poster ដើម្បីផ្សព្វផ្សាយអចលនទ្រព្យ។</p>
                </div>
                {{-- <hr /> --}}
            </li>

        </ul>
        <h2 class="text-xl font-black my-6 text-[#2196f3]">
            ជំនាញរបស់ខ្ញុំ
        </h2>
        <ul class="flex flex-wrap gap-2">
            <li class="btn btn-sm btn-outline ">HTML5</li>
            <li class="btn btn-sm  btn-outline ">CSS3</li>
            <li class="btn btn-sm  btn-outline ">JavaScript</li>
            <li class="btn btn-sm btn-outline ">TailwindCSS</li>
            <li class="btn btn-sm btn-outline ">JQuery</li>
            <li class="btn btn-sm btn-outline ">PHP</li>
            <li class="btn btn-sm btn-outline ">Laravel</li>
            <li class="btn btn-sm btn-outline ">MySQL</li>
            <li class="btn btn-sm btn-outline ">GitHub</li>
            <li class="btn btn-sm btn-outline ">API</li>
            <li class="btn btn-sm btn-outline ">AWS S3</li>
            <li class="btn btn-sm btn-outline">Wireframes</li>
        </ul>

    </article>
</div>
