<header class="sticky top-0 z-30 border-b border-secondary-800/80 bg-inherit">
    <x-app.navigation.navbar>
        <x-slot:start>
            <a href="/" wire:navigate>
                <x-app.ui.logo />
            </a>
        </x-slot:start>

        <x:slot:end>
            <nav class="flex flex-nowrap items-center gap-x-3">
                @foreach ($actions as $action)
                <x-wireuse::actions-link :$action>
                    <x-wireuse::actions-icon :$action />
                    <span class="sr-only">{{ $action->getLabel() }}</span>
                </x-wireuse::actions-link>
                @endforeach
            </nav>
        </x:slot:end>
    </x-app.navigation.navbar>
</header>
