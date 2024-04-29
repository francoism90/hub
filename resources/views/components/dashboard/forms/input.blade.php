@props([
    'field',
])

<input {{ $attributes
    ->cssClass([
        'layer' => 'p-3 h-10 w-full bg-secondary-800/90 border-secondary-500/50 text-base focus:border-secondary-500 focus:border-2 focus:ring-0',
        'error' => '!border-red-500',
    ])
    ->classMerge([
        'layer',
        'error' => $errors->has($field->getWireModel()),
    ])
    ->merge([
        'id' => $field->getName(),
        'wire:model' => $field->getWireModel(),
        'type' => 'text',
    ])
}}>
