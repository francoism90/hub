<footer class="sticky bottom-0 z-30 py-1.5 px-3 bg-inherit border-t border-secondary-800/80">
    <x-wireuse::layout-container class="flex items-center justify-center">
        <x-wireuse::navigation-tabs
            :$navigation
            class:tabs="flex items-center overflow-x-auto gap-x-6"
            class:item="flex-col gap-0.5 justify-stretch max-w-16 line-clamp text-xs font-medium"
            class:icon="size-6 sm:size-7"
        />
    </x-wireuse::layout-container>
</footer>
