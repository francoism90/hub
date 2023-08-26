<div class="min-w-[18rem] max-w-[18rem] self-start rounded bg-gray-900/70 p-6 shadow-md">
    <div class="flex cursor-pointer items-center justify-between pb-4" wire:click="toggle">
        <h3 class="headline">{{ __('By :name', ['name' => $this->name]) }}</h3>
        <x-heroicon-o-chevron-double-right class="h-5 w-5 text-gray-400" />
    </div>

    <div class="max-h-[32rem] overflow-auto px-4">
        <div class="flex flex-col flex-wrap space-y-4">
            @foreach ($this->tags as $tag)
                <a class="text-sm font-medium uppercase text-gray-400 hover:text-primary-500"
                    href="#">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
