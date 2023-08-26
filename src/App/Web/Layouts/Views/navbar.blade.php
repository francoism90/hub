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
                <aside>
                    <div class="flex justify-end">
                        <button
                            class="p-10 focus:outline-none"
                            aria-label="Toggle Menu"
                            @click="open = false">
                                <x-heroicon-o-x-mark class="h-10 w-10" />
                        </button>
                    </div>

                    <nav class="flex flex-col flex-nowrap p-10 space-y-5">
                        <a class="text-2xl font-bold tracking-widest text-gray-100 cursor-pointer">
                            {{ __('Recent') }}
                        </a>

                        <a class="text-2xl font-bold tracking-widest text-gray-100 cursor-pointer">
                            {{ __('Tags') }}
                        </a>

                        <a class="text-2xl font-bold tracking-widest text-gray-100 cursor-pointer">
                            {{ __('Playlists') }}
                        </a>
                    </nav>
                </aside>
            </x-slot:content>
        </x-layouts::drawer>
    </nav>
</header>
