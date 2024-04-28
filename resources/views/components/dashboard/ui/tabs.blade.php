@props([
    'actions',
])

@php
    $current = $actions->current();
@endphp

<div {{ $attributes }}>
    <nav class="flex items-center px-3 gap-x-5 overflow-x-auto border-b border-secondary-500/50">
        @foreach ($actions->all() as $action)
            <x-wireuse::actions-link
                :$action
                class="border-b pb-3"
                class:active="border-primary-400 text-primary-400"
                class:inactive="border-secondary-400 text-secondary-400"
            >
                <x-wireuse::actions-icon
                    :$action
                    class="size-6 sm:size-7"
                />

                <span class="line-clamp text-sm font-medium">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>

    @if ($current?->hasComponent())
        <x-dynamic-component :component="$current->getComponent()" :$action />
    @endif

    @if ($current?->hasLivewire())
        @livewire($current->getLivewire(), ['action' => $current], key($current->getName()))
    @endif
</div>
