<div>
    <div class="bg-base-100 sticky top-0 z-50">
        <div class="navbar max-w-[800px] mx-auto ">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('getPostByCategory', $category['slug']) }}">{{ $category['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a href="{{ route('home') }}">KRS</a>
        </div>
        <div class="navbar-end">

            @livewire('front.search')
            <x-theme-toggle darkTheme="dark" lightTheme="light" />
        </div>
    </div>

    

</div>
