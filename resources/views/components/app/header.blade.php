<header>
    <x-livewire-use::container>
        <x-livewire-use::navbar>
            <x-livewire-use::navbar.start>
                <x-livewire-use::actions.link
                    href="/"
                    class:layer="inline-flex items-center gap-x-4 text-2xl font-medium lowercase hover:text-primary-100"
                    class:active="text-inherit"
                >
                    <x-heroicon-s-play-circle class="h-12 w-12 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-0.5" />
                    <span>{{ config('app.name') }}</span>
                </x-livewire-use::actions.link>
            </x-livewire-use::navbar.start>

            <x-livewire-use::navbar.end>
                <x-livewire-use::layout.join class="gap-x-4">
                    <x-livewire-use::actions.link
                        href="{{ route ('tags.index') }}"
                        aria-label="{{ __('Tags') }}"
                        title="{{ __('Tags') }}"
                    >
                        <x-heroicon-o-hashtag class="h-6 w-6" />
                    </x-livewire-use::actions.link>

                    <x-livewire-use::actions.link
                        href="{{ route('search') }}"
                        aria-label="{{ __('Search') }}"
                        title="{{ __('Search') }}"
                    >
                        <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                    </x-livewire-use::actions.link>

                    <x-livewire-use::dropdown>
                        <x-livewire-use::actions.button>
                            <x-heroicon-o-user-circle class="h-6 w-6" />
                        </x-livewire-use::actions.button>

                        <x-livewire-use::dropdown.content
                            x-anchor.bottom-end.offset.5="$refs.dropdown"
                            class="flex min-w-[16rem] max-w-[16rem] flex-col gap-y-4 rounded bg-gray-900 px-6 py-4"
                        >
                            <section class="flex flex-col flex-nowrap gap-y-1">
                                <x-livewire-use::actions.link href="{{ route('profile.history') }}">
                                    {{ __('History') }}
                                </x-livewire-use::actions.link>

                                <x-livewire-use::actions.link href="{{ route('profile.favorites') }}">
                                    {{ __('Favorites') }}
                                </x-livewire-use::actions.link>

                                <x-livewire-use::actions.link href="{{ route('profile.watchlist') }}">
                                    {{ __('Watchlist') }}
                                </x-livewire-use::actions.link>
                            </section>

                            <section class="flex flex-col flex-nowrap gap-y-3">
                                <x-livewire-use::actions.link
                                    href="{{ route('filament.admin.pages.dashboard') }}"
                                    :navigate="false"
                                >
                                    {{ __('Manage Profile') }}
                                </x-livewire-use::actions.link>

                                <x-livewire-use::actions.button
                                    class="bg-gray-600/50"
                                >
                                    {{ __('Log Out') }}
                                </x-livewire-use::actions.button>
                            </section>
                        </x-livewire-use::dropdown.content>
                    </x-livewire-use::dropdown>
                </x-livewire-use::layout.join>
            </x-livewire-use::navbar.end>
        </x-livewire-use::navigation.navbar>
    </x-livewire-use::container>
</header>
