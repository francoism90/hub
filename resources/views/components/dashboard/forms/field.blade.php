<div {{ $attributes
    ->cssClass([
        'layer' => 'flex flex-col gap-1.5',
    ])
    ->classMerge()
}}>
    {{ $slot }}
</div>
