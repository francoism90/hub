@props([
    'fluid' => false,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'relative mx-auto w-full',
        'padding' => 'px-3',
        'width' => 'max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge([
        'layer',
        'padding',
        'width' => ! $fluid,
    ]);
}}>
    {{ $slot }}
</div>
