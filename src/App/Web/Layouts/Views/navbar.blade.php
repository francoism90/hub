<header class="navbar">
    <a class="navbar-brand" href="/">
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>{{ config('app.name') }}</span>
    </a>

    <nav class="navbar-menu">
        <a class="hidden sm:flex navbar-item">
            {{ __('Recent') }}
        </a>

        <a class="hidden sm:flex navbar-item">
            {{ __('Tags') }}
        </a>

        <a class="hidden sm:flex navbar-item">
            {{ __('Playlists') }}
        </a>

        <a class="navbar-item">
            <livewire:layout-search />
        </a>

        <a
            class="navbar-item"
            href="{{ route('filament.admin.pages.dashboard') }}"
        >
            <x-heroicon-o-user-circle class="h-6 w-6" />
        </a>

        <x-layouts::drawer>
            <x-heroicon-o-bars-3
                @click="open = true"
                class="h-6 w-6 navbar-item sm:hidden cursor-pointer" />

            <x-slot:content>
                <div class="fixed inset-x-0 z-10 min-h-screen w-full transform bg-gray-950/90 duration-300 ease-in-out translate-x-0">
                    <div class="flex justify-end">
                        <button
                            class="p-10 focus:outline-none"
                            aria-label="Toggle Menu"
                            @click="open = false">
                                <x-heroicon-o-x-mark class="h-10 w-10" />
                        </button>
                    </div>

                    <div class="">
                        <livewire:videos-filter :$tag :$search />
                    </div>
                </div>
            </x-slot:content>
        </x-layouts::drawer>
    </nav>
</header>
