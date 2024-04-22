<footer class="border-t border-secondary-800/80">
    <x-wireui::layout-container class="flex items-center justify-center py-1.5 gap-6">
        @foreach ($actions->all() as $action)
            <x-wireuse::actions-link
                :$action
                class="flex-col text-xs gap-1 line-clamp-1"
            >
                <x-icon :name="$component->icon()" class="size-6" />
                <span>{{ $action->getName() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </x-wireui::layout-container>
</footer>
