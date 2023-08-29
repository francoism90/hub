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

        <div class="relative" x-data="{ open: true }">
            <a
                @click="open = true"
                @click.away="open = false"
                @mouseover="open = true"
                class="navbar-item">
                <x-heroicon-o-user-circle class="h-6 w-6" />
            </a>

            <div
                x-show="open"
                x-transition
                class="absolute right-0 top-10 z-20 flex min-w-[16rem] max-w-[16rem] flex-col space-y-4 rounded bg-gray-900 px-6 py-4 shadow-md">
                <div class="flex flex-col flex-nowrap space-y-1">
                    <a href="{{ route('tags.index') }}" class="{{ $active('tags.*', 'navbar-item text-gray-400') }}">
                        {{ __('History') }}
                    </a>

                    <a href="{{ route('tags.index') }}" class="{{ $active('tags.*', 'navbar-item text-gray-400') }}">
                        {{ __('Watch Later') }}
                    </a>
                </div>

                <div class="flex flex-col flex-nowrap space-y-1">
                    <a href="{{ route('tags.index') }}" class="{{ $active('tags.*', 'navbar-item text-gray-400') }}">
                        {{ __('Manage Account') }}
                    </a>
                </div>

                <button class="btn rounded bg-gray-600/50 py-2 text-sm font-medium">
                    {{ __('Log Out') }}
                </button>
            </div>
    </nav>
</header>
