@props([
    'item',
])

<article {{ $attributes
    ->class('w-full h-full snap-center')
    ->merge([
        'wire:key' => $item->getRouteKey(),
    ])
}}>
    {{ $item->title }}
</article>
