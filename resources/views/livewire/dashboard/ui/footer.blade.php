<footer class="sticky bottom-0 z-30 px-3 bg-inherit border-t border-secondary-800/80">
    <x-wireuse::layout-container fluid>
        <x-wireuse::navigation-tabs
            :$navigation
            class:layer="flex h-16 items-center justify-between gap-x-3 overflow-x-auto sm:justify-center sm:gap-x-12"
            class:item="flex flex-col max-w-16 gap-0.5 px-3 justify-stretch line-clamp text-xs font-medium"
            class:icon="size-6 sm:size-7"
        />
    </x-wireuse::layout-container>
</footer>
