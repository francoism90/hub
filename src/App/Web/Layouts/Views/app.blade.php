<!doctype html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#ec4899">
    <meta name="theme-color" content="#ec4899">
    <link rel="manifest" href="/build/manifest.webmanifest">
    <link rel="apple-touch-icon" sizes="180x180" href="/storage/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/storage/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/storage/images/favicon-16x16.png">
    <link rel="mask-icon" href="/storage/images/safari-pinned-tab.svg" color="#ec4899">
    <script id="vite-plugin-pwa:register-sw" src="/build/registerSW.js"></script>
    {!! SEOMeta::generate() !!}
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

<body class="antialiased">

    {{ $slot }}

    @vite('resources/js/app.js')
    @stack('scripts')

</body>

</html>
