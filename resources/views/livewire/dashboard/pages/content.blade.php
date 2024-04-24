<x-wireuse::layout-page>
    <x-wireuse::navigation-tabs
        :$navigation
        class:tabs="flex items-center overflow-x-auto gap-x-5 px-3 border-b border-secondary-500/50"
        class:item="py-3 border-b text-sm font-medium"
        class:active="border-primary-400 text-primary-400"
        class:inactive="border-secondary-400 text-secondary-400"
    />
</x-wireuse::layout-page>
