<footer class="sticky bottom-0 z-30 py-1.5 px-3 bg-inherit border-t border-secondary-800/80">
    <x-wireuse::layout-container fluid>
        <x-wireuse::navigation-tabs
            :$navigation
            class:tabs="flex items-center justify-between gap-x-6 overflow-x-auto sm:justify-center"
            class:item="flex flex-col max-w-16 gap-0.5 justify-stretch line-clamp text-xs font-medium"
            class:icon="size-6 sm:size-7"
        />
    </x-wireuse::layout-container>
</footer>
