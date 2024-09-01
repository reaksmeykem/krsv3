<div>
    <footer class="footer bg-neutral text-neutral-content p-10">
        <div class="max-w-[800px] w-full mx-auto flex flex-wrap justify-between items-center">
        <aside>
            <div class="text-sm"><small>©​ រក្សាសិទ្ធដោយ KRS ឆ្នាំ២០២៤</small></div>
          {{-- <p>
            kemreaksmey.com offers tutorials and resources on languages and frameworks for web development, such as HTML, CSS, Bootstrap, TailwindCSS, PHP, Laravel, Livewire, MySQL, and many more.
          </p> --}}
        </aside>
        <nav class="flex">
          <ul class="flex flex-wrap space-x-4">
            <li><a class="text-xs hover:text-[#2196f3]" href="{{ route('sitemap') }}" wire:navidate >ផែនទីគេហទំព័រ</a></li>
            <li><a class="text-xs hover:text-[#2196f3]" href="{{ route('TermsAndPrivacy') }}" wire:navigate>លក្ខខណ្ឌ និងភាពឯកជន</a></li>
            <li><a class="text-xs hover:text-[#2196f3]" href="{{ route('contact') }}" >ទំនាក់ទំនង</a></li>
            <li><a class="text-xs hover:text-[#2196f3]" href="{{ route('about') }}" wire:navigate>អំពីខ្ញុំ</a></li>
          </ul>
        </nav>
    </div>
    </footer>
</div>
