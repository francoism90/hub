<aside class="flex w-full flex-col space-y-8">
    @if ($this->hasProperty('tags'))
        <div class="w-full rounded bg-gray-900 p-6">
            <div class="flex cursor-pointer items-center justify-between pb-4" wire:click="toggleTags">
                <h3 class="headline">{{ str($this->tagType)->plural() }}</h3>
                <x-heroicon-o-chevron-double-right class="h-5 w-5 text-gray-400" />
            </div>

            <div class="flex h-96 max-h-[24rem] flex-col space-y-1.5 overflow-auto px-4 text-gray-400">
                @foreach ($this->tagOptions as $item)
                    <label
                        for="tag-{{ $item->getRouteKey() }}"
                        class="@if ($this->hasTag($item)) text-primary-500 @endif cursor-pointer text-sm font-medium uppercase hover:text-primary-500">
                        {{ $item->name }}
                    </label>

                    <input
                        type="checkbox"
                        class="hidden"
                        id="tag-{{ $item->getRouteKey() }}"
                        value="{{ $item->getRouteKey() }}"
                        wire:model.live="tags" />
                @endforeach
            </div>
        </div>
    @endif
</aside>
