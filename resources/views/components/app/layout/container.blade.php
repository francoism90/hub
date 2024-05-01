@props([
    'fluid' => false,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'relative w-full',
        'padding' => 'px-3',
        'width' => 'mx-auto max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge([
        'layer',
        'padding',
        'width' => ! $fluid,
    ]);
}}>
    {{ $slot }}
</div>
