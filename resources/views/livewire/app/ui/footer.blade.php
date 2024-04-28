@php
    $current = $actions->current();
@endphp

<footer class="sticky bottom-0 z-30 px-3 bg-inherit border-t border-secondary-800/80">
    <x-wireuse::layout-container fluid>
        <nav class="flex h-16 items-center justify-between gap-x-3 overflow-x-auto sm:justify-center sm:gap-x-12">
            @foreach ($actions->items as $action)
                <x-wireuse::actions-link
                    :$action
                    class="flex-col max-w-16 gap-1 px-3"
                >
                    <x-wireuse::actions-icon
                        :$action
                        class="size-6 sm:size-7"
                    />

                    <span class="line-clamp text-xs font-medium">{{ $action->getLabel() }}</span>
                </x-wireuse::actions-link>
            @endforeach
        </nav>
    </x-wireuse::layout-container>
</footer>
