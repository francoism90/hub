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

        <x-layouts::drawer>
            <x-heroicon-o-bars-3
                @click="open = true"
                class="h-6 w-6 cursor-pointer sm:hidden" />

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

                    <nav
                        class="flex flex-col flex-nowrap space-y-5 p-10 text-2xl font-bold tracking-widest text-gray-100">
                        <a href="{{ route('videos.index') }}" class="{{ $active('videos.index', 'drawer-item') }}">
                            {{ __('Videos') }}
                        </a>

                        <a href="{{ route('tags.index') }}" class="{{ $active('tags.*', 'drawer-item') }}">
                            {{ __('Tags') }}
                        </a>

                        <a href="{{ route('playlists.index') }}" class="{{ $active('playlists.*', 'drawer-item') }}">
                            {{ __('Playlists') }}
                        </a>
                    </nav>
                </aside>
            </x-slot:content>
        </x-layouts::drawer>
    </nav>
</header>
