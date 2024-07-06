<!doctype html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="application-name"
        content="{{ config('app.name') }}"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="msapplication-TileColor"
        content="#030712"
    >
    <meta
        name="theme-color"
        content="#030712"
    >
    {!! SEOMeta::generate() !!}
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{ asset('storage/images/apple-touch-icon.png') }}"
    >
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('storage/images/favicon-32x32.png') }}"
    >
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('storage/images/favicon-16x16.png') }}"
    >
    <link
        rel="manifest"
        href="{{ asset('build/manifest.webmanifest') }}"
    >
    <script
        id="vite-plugin-pwa:register-sw"
        src="{{ asset('build/registerSW.js') }}"
        data-navigate-track
    ></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite('resources/css/app.css')
    @googlefonts()
    @googlefonts('serif')
    @googlefonts('code')
</head>

<body class="h-viewport relative flex flex-col overscroll-none bg-secondary-950 text-base antialiased">

        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                    <div class="font-mono px-4 text-lg text-secondary-500 border-r border-secondary-400 tracking-wider">
                        @yield('code')
                    </div>

                    <div class="font-serif ml-4 text-lg text-secondary-500 uppercase tracking-wider">
                        @yield('message')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
