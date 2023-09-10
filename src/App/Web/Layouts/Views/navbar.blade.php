<header class="navbar">
    <a
        href="/"
        class="navbar-brand"
        wire:navigate.hover>
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>{{ config('app.name') }}</span>
    </a>

    <nav class="navbar-menu">
        <a
            href="{{ route('tags.index') }}"
            class="{{ $active('tags.*', 'navbar-item') }}"
            wire:navigate.hover>
            <x-heroicon-o-hashtag class="h-6 w-6" />
        </a>

        <livewire:layout-search />

        <div class="relative" x-data="{ open: false }">
            <a
                @click="open = true"
                @click.away="open = false"
                @mouseover="open = true"
                class="navbar-item">
                <x-heroicon-o-user-circle class="h-6 w-6" />
            </a>

            <div
                x-cloak
                x-show="open"
                x-transition
                role="dialog"
                class="absolute right-0 top-10 z-20 flex min-w-[16rem] max-w-[16rem] flex-col space-y-4 rounded bg-gray-900 px-6 py-4 shadow-md">
                <div class="flex flex-col flex-nowrap space-y-1">
                    <a
                        href="{{ route('profile.history') }}"
                        class="{{ $active('profile.history', 'navbar-item text-gray-400') }}"
                        wire:navigate.hover>
                        {{ __('History') }}
                    </a>

                    <a
                        href="{{ route('profile.favorites') }}"
                        class="{{ $active('profile.favorites', 'navbar-item text-gray-400') }}"
                        wire:navigate.hover>
                        {{ __('Favorites') }}
                    </a>

                    <a
                        href="{{ route('profile.watchlist') }}"
                        class="{{ $active('profile.watchlist', 'navbar-item text-gray-400') }}"
                        wire:navigate>
                        {{ __('Watchlist') }}
                    </a>
                </div>

                <div class="flex flex-col flex-nowrap space-y-1">
                    <a
                        href="{{ route('filament.admin.pages.dashboard') }}"
                        class="navbar-item text-gray-400">
                        {{ __('Manage Profile') }}
                    </a>
                </div>

                <button
                    class="btn rounded bg-gray-600/50 py-2 text-sm font-medium"
                    href="{{ route('filament.admin.auth.logout') }}">
                    {{ __('Log Out') }}
                </button>
            </div>
        </div>
    </nav>
</header>
