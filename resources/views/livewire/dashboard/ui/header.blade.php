<header class="sticky z-30 top-0 bg-inherit border-b border-secondary-800/80">
    <x-wireuse::navigation-navbar class:padding="p-3">
        <x-slot:start>
            <a href="/" wire:navigate>
                <x-app.ui.logo />
            </a>
        </x-slot:start>

        <x:slot:end>
            <nav class="flex flex-nowrap gap-x-3">
                @foreach ($navigation->items as $action)
                    <x-wireuse::actions-link
                        :$action
                        class:label="sr-only"
                        class:icon="size-6"
                    />
                @endforeach
            </nav>
        </x:slot:end>
    </x-wireuse::navigation-navbar>
</header>
