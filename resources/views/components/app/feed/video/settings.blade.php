@props([
    'settings',
])

<div class="absolute left-3 top-3 z-30">
    <nav class="flex items-center gap-3 overflow-x-auto">
        @foreach ($settings as $action)
        <x-wireuse::actions-link :$action>
            <x-wireuse::actions-icon :$action />
            <span class="sr-only">{{ $action->getLabel() }}</span>
        </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
