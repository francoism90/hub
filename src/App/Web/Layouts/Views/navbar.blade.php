<header class="navbar">
    <a class="navbar-brand" href="/">
        <x-heroicon-s-play-circle class="navbar-logo" />
        <span>{{ config('app.name') }}</span>
    </a>

    <nav class="navbar-menu">
        <div class="hidden sm:flex">
            <a class="navbar-item">
                {{ __('Recent') }}
            </a>

            <a href="{{ route('tags.index') }}" class="navbar-item">
                {{ __('Tags') }}
            </a>

            <a class="navbar-item">
                {{ __('Playlists') }}
            </a>
        </div>

        <livewire:layout-search />

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

                    <nav class="flex flex-col flex-nowrap space-y-5 p-10 text-2xl font-bold tracking-widest text-gray-100">
                        <a class="cursor-pointer">
                            {{ __('Recent') }}
                        </a>

                        <a href="{{ route('tags.index') }}" class="cursor-pointer">
                            {{ __('Tags') }}
                        </a>

                        <a class="cursor-pointer">
                            {{ __('Playlists') }}
                        </a>
                    </nav>
                </aside>
            </x-slot:content>
        </x-layouts::drawer>
    </nav>
</header>
