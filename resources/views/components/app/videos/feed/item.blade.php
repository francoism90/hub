@props([
    'item',
])

<article {{ $attributes
    ->class('relative w-full h-full snap-center')
    ->merge([
        'wire:key' => $item->getRouteKey(),
    ])
}}>
    <img
        alt="{{ $item->title }}"
        srcset="{{ $item->placeholder }}"
        src="{{ $item->thumbnail }}"
        class="absolute inset-0 object-fill blur-3xl brightness-50 saturate-50"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <x-app.videos.feed.preview />
</article>
