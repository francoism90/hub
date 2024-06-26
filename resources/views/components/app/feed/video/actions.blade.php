@props([
    'actions',
])

<div class="absolute bottom-4 right-4 z-30 sm:-right-12">
    <nav class="flex flex-col items-center justify-center gap-y-3">
        @foreach ($actions as $action)
        <x-wireuse::actions-link :$action>
            <x-wireuse::actions-icon :$action />
            <span class="sr-only">{{ $action->getLabel() }}</span>
        </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
