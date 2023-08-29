<header class="navbar">
    <a class="navbar-brand" href="/">
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>{{ config('app.name') }}</span>
    </a>

    <nav class="navbar-menu">
        <a href="{{ route('tags.index') }}" class="{{ $active('tags.*', 'navbar-item') }}">
            <x-heroicon-o-hashtag class="h-6 w-6" />
        </a>

        <livewire:layout-search />

        <a href="{{ route('filament.admin.pages.dashboard') }}">
            <x-heroicon-o-user-circle class="h-6 w-6" />
        </a>
    </nav>
</header>
