@props([
    'id',
    'items',
])

@php
    $tags = $items->select(['name', 'prefixed_id'])->toArray();
@endphp

<div
    x-data="{ tags: $wire.entangle('{{ $id }}'), map: {{ Js::from($tags) }} }"
    x-init="$watch('map', value => tags = value)"

    {{ $attributes
        ->cssClass([
            'layer' => 'flex items-start gap-2 p-3 min-h-24 max-h-32 w-full bg-secondary-800/90 border border-secondary-500/50 text-base focus:border-secondary-500 focus:border-2 focus:ring-0',
            'error' => '!border-red-500',
        ])
        ->classMerge([
            'layer',
            'error' => $errors->has($id),
        ])
        ->merge([
            'id' => $id,
        ])
    }}
>
    <template x-for="(item, index) in map" :key="item.prefixed_id">
        <a
            x-text="item.name"
            x-on:click="map.splice(index, 1)"
        >
        </a>
    </template>

        {{-- <a
            wire:click="$dispatchTo('form', 'show-post-modal')"
            class="inline-flex items-center gap-1 text-sm font-medium px-3 h-7 bg-primary-500/50"
        >
            {{ $item->name }}
            <x-icon name="heroicon-c-x-circle" class="size-3" />
        </a> --}}
</div>
