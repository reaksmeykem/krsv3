<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | kemreaksmey.com</title>
    <link rel="stylesheet" href="{{ asset('plugin/style.css') }}">

    {{-- google font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    <div id="loading-spinner" class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-100 z-50">
        <div class="dual-ring"></div>
    </div>

<div class="flex items-center justify-center h-screen w-screen">
    @livewire('login')
</div>

@include('dashboard.plugin.loading')

@livewireScripts
</body>
</html>
