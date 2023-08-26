<div class="sm:min-w-[18rem] sm:max-w-[18rem] self-start overflow-auto">
    <div class="rounded sm:bg-gray-900/70 p-6 shadow-md">
        <div class="flex cursor-pointer items-center justify-between pb-4" wire:click="toggle">
            <h3 class="headline">{{ __('By :name', ['name' => $this->tagLabel]) }}</h3>
            <x-heroicon-o-chevron-double-right class="h-5 w-5 text-gray-400" />
        </div>

        <div class="max-h-[32rem] overflow-auto px-4">
            <div class="flex flex-col flex-wrap space-y-4">
                @foreach ($this->tags as $item)
                    <a
                        class="{{ $item->getRouteKey() === $tag ? 'text-primary-500' : '' }} cursor-pointer text-sm font-medium uppercase text-gray-400 hover:text-primary-500"
                        wire:click="$parent.setTag('{{ $item->getRouteKey() }}')">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
