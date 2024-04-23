<footer class="border-t border-secondary-800/80">
    <x-wireuse::layout-container class="flex items-center justify-center py-1.5 gap-6 sm:gap-9 overflow-x-auto">
        <x-wireuse::navigation-tabs :$navigation />

        {{-- @foreach ($actions as $action)
            <x-wireuse::actions-link
                :$action
                class="flex-col text-xs gap-1 line-clamp-1"
                class:inactive="text-white/90"
            >
                <x-icon :name="$component->icon()" class="size-6" />
                <span>{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach --}}
    </x-wireuse::layout-container>
</footer>
