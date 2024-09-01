<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @yield('seo')
    {{-- clarity --}}
    <script type="text/javascript" defer>
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "nuy3d9ok4c");
    </script>
     {{-- google font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}
</head>
<style>
    *{
        font-family: "Inter","Hanuman";
        font-size: 18px;
    }
    body{
        font-family: "Inter","Hanuman";
        font-size: 18px;
   }
</style>
<body class=" font-sans antialiased bg-base-200/50 dark:bg-base-200 ">
    <a id="back-to-top" href="#" class="fixed z-50 bottom-4 right-4 bg-[#2196f3] text-white p-2 rounded-full shadow-lg transition duration-300 opacity-0 invisible">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>
    </a>
    @livewire('front.menu')
    <div class="max-w-[800px] min-h-screen mx-auto my-8 px-5 md:px-0">
        @yield('contentFrontend')
    </div>
    @livewire('front.footer')
    @include('cookie-consent::index')
    <x-toast />
    {{-- hcaptcha --}}
    <script src="https://hcaptcha.com/1/api.js" async defer></script>

    {{-- end hcaptcha --}}
    <script src="{{ asset('plugin/app.js') }}" defer></script>

</body>
</html>
