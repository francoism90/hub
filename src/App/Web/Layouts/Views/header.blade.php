<x-ui-header>
    <x-ui-container>
        <x-ui-navbar>
            <x-slot:start>
                <x-ui-link
                    href="/"
                    class="navbar-brand"
                    wire:navigate
                >
                    <x-heroicon-s-play-circle class="navbar-logo" />
                    <span>{{ config('app.name') }}</span>
                </x-ui-link>
            </x-slot:start>

            <x-slot:end>
                <nav class="navbar-menu">
                    <x-ui-link
                        route="tags.index"
                        aria-label="{{ __('Tags') }}"
                        title="{{ __('Tags') }}"
                    >
                        <x-heroicon-o-hashtag class="h-6 w-6" />
                    </x-ui-link>

                    <x-ui-link
                        route="search"
                        aria-label="{{ __('Search') }}"
                        title="{{ __('Search') }}"
                    >
                        <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                    </x-ui-link>

                    <x-ui-dropdown>
                        <x-ui-button class="navbar-item">
                            <x-heroicon-o-user-circle class="h-6 w-6" />
                        </x-ui-button>

                        <x-slot:content>
                            <div
                                x-anchor.bottom-end.offset.20="$refs.dropdown"
                                class="flex min-w-[16rem] max-w-[16rem] flex-col gap-y-4 rounded bg-gray-900 px-6 py-4"
                            >
                                <section class="flex flex-col flex-nowrap gap-y-1">
                                    <x-ui-link route="profile.history">
                                        {{ __('History') }}
                                    </x-ui-link>

                                    <x-ui-link route="profile.favorites">
                                        {{ __('Favorites') }}
                                    </x-ui-link>

                                    <x-ui-link route="profile.watchlist">
                                        {{ __('Watchlist') }}
                                    </x-ui-link>
                                </section>

                                <section class="flex flex-col flex-nowrap gap-y-1">
                                    <x-ui-link
                                        class="btn rounded bg-gray-600/50 py-2 text-sm font-medium"
                                        href="{{ route('filament.admin.pages.dashboard') }}"
                                    >
                                        {{ __('Manage Profile') }}
                                    </x-ui-link>
                                </section>
                            </div>
                        </x-slot:content>
                    </x-ui-dropdown>
                </nav>
            </x-slot:end>
        </x-ui-navbar>
    </x-ui-container>
</x-ui-header>
