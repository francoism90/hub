<!doctype html>
<html
    class="scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="default"
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
    @vite('resources/js/app.ts')
    @inertiaHead
    @googlefonts()
    @googlefonts('serif')
    @googlefonts('code')
</head>

<body class="antialiased">

@inertia

</body>
</html>
