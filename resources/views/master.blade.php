<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('plugin/style.css') }}">
    {{-- humix.com --}}
    <meta name="humix-site-verification" content="9E0WWlsz29BIbxNkhVNvZzxwx9SOJS" />

    {!! seo() !!}
    {{-- google font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugin/style.css') }}">

    {{-- google analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga4.measurementId') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.ga4.measurementId') }}');
    </script>
    {{-- end google analytics --}}

    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class=" bg-[#F5F7F8] text-[#45474B]">

    <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-100 z-50">
        <div class="dual-ring"></div>
    </div>

    @livewire('front.navbar')

    <div class="mx-auto max-w-screen-md">
        @yield('content')
    </div>


    @livewire('front.footer')
    @include('dashboard.plugin.loading')
    @livewireScripts



</body>
</html>
