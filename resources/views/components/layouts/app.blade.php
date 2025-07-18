<!doctype html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<meta name="application-name" content="{{ config('app.name') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileColor" content="#030712">
<meta name="theme-color" content="#030712">
{!! SEO::generate(true) !!}
<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="{{ asset('storage/images/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/images/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
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

<body class="h-screen min-h-screen relative flex flex-col overflow-x-hidden bg-secondary-950 text-secondary-50 antialiased">

<x-app.ui.header />

<div class="flex-1">
    {{ $slot }}
</div>

<x-app.ui.footer />

@vite('resources/js/app.js')
@stack('scripts')

</body>
</html>
