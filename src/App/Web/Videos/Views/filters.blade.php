<div class="bg-gray-900/70 shadow-md rounded min-w-[18rem] max-w-[18rem] p-6">
    <div wire:click="toggle">
        <h3 class="headline">{{ __('By :name', ['name' => $this->name]) }}</h3>
    </div>

    <div class="overflow-auto max-h-[32rem]">
        <div class="flex flex-col flex-wrap space-y-4 p-4">
            @foreach ($this->tags as $tag)
                <a class="uppercase text-sm font-medium text-gray-400 hover:text-primary-500" href="#">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
