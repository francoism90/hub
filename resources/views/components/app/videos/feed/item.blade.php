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

    <div class="absolute z-10 mx-auto inset-0 w-3/5">
        <x-app.videos.feed.preview />
        <x-app.videos.feed.details />
    </div>
</article>
