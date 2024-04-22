<footer class="border-t border-secondary-800/80">
    <x-wireui::layout-container class="flex items-center justify-center py-1.5 gap-6">
        @foreach ($items->all() as $item)
            <x-wireui::actions-link
                route="{{ $item->route }}"
                aria-label="{{ $item->name }}"
                title="{{ $item->name }}"
                class="flex-col text-xs gap-1 line-clamp-1 max-w-24"
            >
                {{ $component->getUrl() }}

                <x-icon name="{{ $item->icon }}" class="size-6" />
                <span>{{ $item->name }}</span>
        </x-wireui::actions-link>
        @endforeach
    </x-wireui::layout-container>
</footer>
