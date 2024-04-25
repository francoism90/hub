@props([
    'item',
])

<article {{ $attributes
    ->class('w-screen h-screen max-h-[calc(100dvh-65px)]')
    ->merge([
        'wire:key' => $item->getRouteKey(),
    ])
}}>>
    {{ $item->title }}
</article>
