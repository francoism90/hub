<button
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 items-center justify-center cursor-pointer',
            'input' => 'px-3 h-8 text-sm font-medium',
            'primary' => 'bg-primary-500 rounded text-secondary-100',
            'secondary' => '',
        ])
        ->mergeAttributes($action->getBladeAttributes())
        ->classMerge([
            'layer',
            'input',
        ])
        ->merge([
            'x-data' => $action->hasState(),
            'aria-label' => $action->getLabel(),
            'type' => 'button',
        ])
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</button>
