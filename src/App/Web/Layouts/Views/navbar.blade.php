<header class="navbar">
    <a class="navbar-brand" href="/">
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>Hub</span>
    </a>

    <nav class="navbar-menu">
        <a class="navbar-item">
            {{ __('Recent') }}
        </a>

        <a class="navbar-item">
            {{ __('Tags') }}
        </a>

        <a class="navbar-item">
            {{ __('Playlists') }}
        </a>

        <a class="navbar-item">
            <x-videos::search />
        </a>

        <a class="navbar-item" href="{{ route('filament.admin.pages.dashboard')}}">
            <x-heroicon-o-user-circle class="h-6 w-6" />
        </a>
    </nav>
</header>
