<!doctype html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#39336c" />
    <meta name="msapplication-TileColor" content="#39336c" />
    <meta name="theme-color" content="#39336c" />
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Hub App" />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite('src/App/Web/Resources/Assets/css/app.css')
    @googlefonts('sans')
    @googlefonts('serif')
    @googlefonts('code')
</head>

<body class="antialiased">

    {{ $slot }}

    @vite('src/App/Web/Resources/Assets/js/app.js')
    @stack('scripts')

</body>

</html>
