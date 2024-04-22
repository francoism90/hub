<header>
    <x-wireui::layout-container>
        <x-wireui::navigation-navbar>
            <x-slot:start>
                <x-wireui::actions-link
                    route="dashboard.index"
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
                        <x-heroicon-o-rectangle-stack class="size-6" />
                    </x-wireui::actions-link>

                    <x-wireui::actions-link
                        route="tags.index"
                        aria-label="{{ __('Tags') }}"
                        title="{{ __('Tags') }}"
                    >
                        <x-heroicon-o-hashtag class="size-6" />
                    </x-wireui::actions-link>

                    <x-wireui::actions-link
                        route="tags.index"
                        aria-label="{{ __('Tags') }}"
                        title="{{ __('Tags') }}"
                    >
                        <x-heroicon-o-users class="size-6" />
                    </x-wireui::actions-link>
                </x-wireui::layout-join>
            </x-slot:end>
        </x-wireui::navigation-navbar>
    </x-wireui::layout-container>
</header>
