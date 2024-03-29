<div
    class="flex flex-row h-8 max-h-8 gap-x-2 w-full overflow-y-hidden overflow-x-scroll"
    wire:poll.keep-alive.900s
>
    @foreach ($this->items as $key => $item)
        <button
            wire:key="search-{{ $key }}"
            wire:click.prevent="$set('value', '{{ $key == $value ? '' : $key }}')"
            @class([
                "flex-shrink-0 h-8 py-0 px-3 gap-x-4 rounded border border-gray-700/30 bg-gray-900/75 text-sm",
                'bg-white/15' => $key == $value,
            ])
        >
            {{ $item }}
        </button>
    @endforeach
</div>
