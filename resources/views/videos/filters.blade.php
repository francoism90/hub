<div class="flex w-full h-10 overflow-hidden overflow-x-auto gap-3">
    @foreach ($this->items as $key => $item)
        <x-livewire-use::forms-label
            wire:key="search-{{ $key }}"
            wire:click.prevent="$set('value', '{{ $key == $value ? '' : $key }}')"
            @class([
                "h-8 py-0 px-3 gap-x-4 rounded border border-gray-700/30 bg-gray-900/75 text-sm",
                'bg-white/15' => $key == $value,
            ])
        >
            {{ $item }}
        </x-livewire-use::forms-label>
    @endforeach
</div>
