<footer class="sticky bottom-0 z-30 h-16 max-h-16 w-full bg-secondary-950">
    <x-app.layout.container fluid>
        <nav class="flex h-16 items-center justify-between gap-x-3 overflow-x-auto border-t border-secondary-800/80 sm:justify-center sm:gap-x-12">
            @foreach ($actions as $action)
            <x-wireuse::actions-link
                :$action
                class="max-w-16 flex-col gap-1 px-3"
            >
                <x-wireuse::actions-icon :$action />
                <span class="line-clamp text-xs font-medium">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
            @endforeach
        </nav>
    </x-app.layout.container>
</footer>
