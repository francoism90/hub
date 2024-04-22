<header class="border-b border-secondary-800/80">
    <x-wireui::navigation-navbar class:padding="py-2 px-6">
        <x-slot:start>
            <x-wireuse::actions-link :action="$homeUrl()">
                <x-app.ui.logo />
            </x-wireuse::actions-link>
        </x-slot:start>

        {{-- <x-slot:end>
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
        </x-slot:end> --}}
    </x-wireui::navigation-navbar>
</header>
