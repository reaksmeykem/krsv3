<!DOCTYPE html>
<html class="scrollbar-custom" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    {!! seo() !!}
    {{-- google font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">


    {{-- google analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga4.measurementId') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.ga4.measurementId') }}');
    </script>
    {{-- end google analytics --}}

    {{-- google ads --}}
    <meta name="google-adsense-account" content="ca-pub-2402494236829690">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2402494236829690"
    crossorigin="anonymous"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('plugin/style.css') }}">
</head>
<body class=" bg-[#F5F7F8] text-[#45474B] ">

    {{-- <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-100 z-50">
        <div class="dual-ring"></div>
    </div> --}}

    @livewire('front.navbar')

    <div class="mx-auto max-w-screen-md">
        @yield('content')
    </div>


    @livewire('front.footer')
    {{-- @include('dashboard.plugin.loading') --}}
    @livewireScripts

    {{-- lazyloading image --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Fallback for browsers that don't support IntersectionObserver
                // Load all images immediately
                lazyImages.forEach(function(lazyImage) {
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy");
                });
            }
        });
        </script>
</body>
</html>
