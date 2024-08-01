<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    {{-- google font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    {{-- datable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.tailwindcss.css">
    {{-- main style --}}
    <link rel="stylesheet" href="{{ asset('plugin/style.css') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 overflow-x-hidden">
    <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-100 z-50">
        <div class="dual-ring"></div>
    </div>
    <div class="max-w-screen mx-auto">
        @livewire('dashboard.side-bar')
    </div>
    <div class="max-w-screen-xl mx-auto">
        <div>
            @yield('content')
        </div>
    </div>

{{-- @include('dashboard.filemanager') --}}
{{-- sweet alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />

@include('dashboard.plugin.loading')


@livewireScripts

</body>
</html>
