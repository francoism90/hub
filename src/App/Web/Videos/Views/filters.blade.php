<aside class="flex w-full flex-col space-y-8">
    @if ($showTags)
        <div class="w-full rounded bg-gray-900 px-6 py-4">
            <div class="flex cursor-pointer items-center justify-between pb-4" wire:click="toggleTags">
                <h3 class="headline">{{ $this->tagType }}</h3>
                <x-heroicon-o-chevron-double-right class="h-5 w-5 text-gray-400" />
            </div>

            <div class="flex h-96 max-h-[24rem] flex-col space-y-1.5 overflow-auto px-4 text-gray-400">
                @foreach ($this->tagOptions as $item)
                    <label
                        for="tag-{{ $item->getRouteKey() }}"
                        class="@if ($this->hasTags($item)) text-primary-500 @endif cursor-pointer text-sm font-medium uppercase hover:text-primary-500">
                        {{ $item->name }}
                    </label>

                    <input
                        type="checkbox"
                        id="tag-{{ $item->getRouteKey() }}"
                        class="hidden"
                        value="{{ $item->getRouteKey() }}"
                        wire:model.live="tags" />
                @endforeach
            </div>
        </div>
    @endif
</aside>
