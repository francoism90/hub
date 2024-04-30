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
        name="csrf-token"
        content="{{ csrf_token() }}"
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

<body class="relative overscroll-contain flex flex-col h-[calc(100dvh)] antialiased bg-secondary-950 text-base">

    <livewire:livewire.dashboard.ui.header />

    <div class="flex-1">
        {{ $slot }}
    </div>

    <livewire:livewire.dashboard.ui.footer />

    @vite('resources/js/app.js')
    @stack('scripts')

</body>
</html>
