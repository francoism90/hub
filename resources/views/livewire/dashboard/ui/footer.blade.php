<footer class="border-t border-secondary-800/80">
    <x-wireuse::layout-container class="flex items-center justify-center py-1.5 gap-6 sm:gap-9 overflow-x-auto">
        <x-wireuse::navigation-tabs
            :$navigation
            class="gap-x-5"
            class:tab="flex-col border-b text-sm font-medium"
            {{-- class:active="border-primary-400 text-primary-400" --}}
            {{-- class:inactive="border-secondary-400 text-secondary-400" --}}
        />
    </x-wireuse::layout-container>
</footer>
