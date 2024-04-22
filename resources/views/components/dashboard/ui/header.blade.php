<header class="border-b border-secondary-800/80">
    <x-wireui::navigation-navbar class:padding="p-3">
        <x-slot:start>
            <x-wireuse::actions-link :action="$homeUrl()">
                <x-app.ui.logo />
            </x-wireuse::actions-link>
        </x-slot:start>
    </x-wireui::navigation-navbar>
</header>
