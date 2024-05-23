@props([
    'vertical' => false,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center gap-3',
        'horizontal' => 'flex-row flex-wrap sm:flex-nowrap',
        'vertical' => 'flex-col',
    ])
    ->classMerge([
        'layer',
        'horizontal' => ! $vertical,
        'vertical' => $vertical,
    ])
}}>
    {{ $slot }}
</div>
