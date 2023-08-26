<header class="navbar">
    <a class="navbar-brand" href="/">
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>{{ config('app.name') }}</span>
    </a>

    <nav class="navbar-menu">
        <a class="navbar-item hidden sm:flex">
            {{ __('Recent') }}
        </a>

        <a class="navbar-item hidden sm:flex">
            {{ __('Tags') }}
        </a>

        <a class="navbar-item hidden sm:flex">
            {{ __('Playlists') }}
        </a>

        <a class="navbar-item">
            <livewire:layout-search />
        </a>

        <a
            class="navbar-item"
            href="{{ route('filament.admin.pages.dashboard') }}">
            <x-heroicon-o-user-circle class="h-6 w-6" />
        </a>

        <x-layouts::drawer>
            <x-heroicon-o-bars-3
                @click="open = true"
                class="navbar-item h-6 w-6 cursor-pointer sm:hidden" />

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

                    <nav class="flex flex-col flex-nowrap space-y-5 p-10">
                        <a class="cursor-pointer text-2xl font-bold tracking-widest text-gray-100">
                            {{ __('Recent') }}
                        </a>

                        <a class="cursor-pointer text-2xl font-bold tracking-widest text-gray-100">
                            {{ __('Tags') }}
                        </a>

                        <a class="cursor-pointer text-2xl font-bold tracking-widest text-gray-100">
                            {{ __('Playlists') }}
                        </a>
                    </nav>
                </aside>
            </x-slot:content>
        </x-layouts::drawer>
    </nav>
</header>
