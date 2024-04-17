<header>
    <x-wireui::layout-container>
        <x-wireui::navigation-navbar>
            <x-slot:start>
                <x-wireui::actions-link
                    href="/"
                    class:layer="inline-flex items-center gap-x-4 text-2xl font-medium lowercase hover:text-primary-100"
                    class:active="text-inherit"
                >
                    <x-heroicon-s-play-circle class="size-12 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-0.5" />
                    <span>{{ config('app.name') }}</span>
                </x-wireui::actions-link>
            </x-slot:start>

            <x-slot:end>
                <x-wireui::layout-join class="gap-x-4">
                    <x-wireui::actions-link
                        route="tags.index"
                        aria-label="{{ __('Tags') }}"
                        title="{{ __('Tags') }}"
                    >
                        <x-heroicon-o-hashtag class="size-6" />
                    </x-wireui::actions-link>

                    <x-wireui::actions-link
                        route="search"
                        aria-label="{{ __('Search') }}"
                        title="{{ __('Search') }}"
                    >
                        <x-heroicon-o-magnifying-glass class="size-6" />
                    </x-wireui::actions-link>

                    <x-wireui::actions-dropdown>
                        <x-slot:actions>
                            <x-wireui::actions-button class:layer="block">
                                <x-heroicon-o-user-circle class="size-6" />
                            </x-wireui::actions-button>
                        </x-slot:actions>

                        <div
                            x-anchor.bottom-end.offset.5="$refs.dropdown"
                            class="flex min-w-64 max-w-64 flex-col gap-y-4 rounded bg-gray-900 px-6 py-4"
                        >
                            <section class="flex flex-col flex-nowrap gap-y-1">
                                <x-wireui::actions-link route="profile.history">
                                    {{ __('History') }}
                                </x-wireui::actions-link>

                                <x-wireui::actions-link route="profile.favorites">
                                    {{ __('Favorites') }}
                                </x-wireui::actions-link>

                                <x-wireui::actions-link route="profile.watchlist">
                                    {{ __('Watchlist') }}
                                </x-wireui::actions-link>
                            </section>

                            <section class="flex flex-col flex-nowrap gap-y-3">
                                <x-wireui::actions-link
                                    route="filament.admin.pages.dashboard"
                                    external
                                >
                                    {{ __('Manage Profile') }}
                                </x-wireui::actions-link>
                            </section>
                        </div>
                    </x-wireui::actions-dropdown>
                </x-wireui::layout-join>
            </x-slot:end>
        </x-wireui::navigation-navbar>
    </x-wireui::layout-container>
</header>
