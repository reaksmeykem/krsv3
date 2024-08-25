<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

     {{-- PhotoSwipe --}}
     <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css" rel="stylesheet">

    {{-- Chart.js  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route>
                <x-theme-toggle darkTheme="dark" lightTheme="light" />
                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logout" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                @auth()
                    @can('view dashboard')
                    <x-menu-item title="Dashbaord" icon="o-sparkles" link="{{ route('dashboard') }}" />
                    @endcan
                    @can('view post')
                    <x-menu-sub title="Posts" icon="o-cog-6-tooth">
                        <x-menu-item title="Content" icon="o-wifi" link="{{ route('post') }}" />
                        @can('view category')
                        <x-menu-item title="Category" icon="o-archive-box" link="{{ route('category') }}" />
                        @endcan
                        @can('view tag')
                        <x-menu-item title="Tags" icon="o-archive-box" link="{{ route('tag') }}" />
                        @endcan
                    </x-menu-sub>
                    @endcan
                    @can('view user')
                    <x-menu-sub title="Admin" icon="o-cog-6-tooth">
                        <x-menu-item title="Users" icon="o-wifi" link="user" />
                        @can('view role')
                        <x-menu-item title="Roles" icon="o-archive-box" link="role" />
                        @endcan
                        @can('view permission')
                        <x-menu-item title="Permissions" icon="o-archive-box" link="permission" />
                        @endcan
                    </x-menu-sub>
                    @endcan
                @endauth
                {{-- <x-menu-item title="Hello" icon="o-sparkles" link="/" /> --}}

                @guest()
                <x-menu-item title="Login" icon="o-sparkles" link="{{ route('login') }}" />
                @endguest

            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>


    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
