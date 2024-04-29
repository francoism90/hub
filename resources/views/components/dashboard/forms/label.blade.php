@props([
    'field',
])

<label {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center text-sm cursor-pointer',
        'error' => 'text-red-500',
        'hint' => 'pt-1 text-red-500',
        'required' => 'px-1 text-primary-400',
    ])
    ->classMerge([
        'layer',
        'error' => $errors->has($field->getName()),
    ])
    ->merge([
        'for' => $field->getName(),
    ])
}}>
    {{ $field->getLabel() }}

    {{-- @if ($required)
        <span class="{{ $attributes->classFor('required') }}">*</span>
    @endif

    @if ($hint)
        <p class="{{ $attributes->classFor('hint') }}">
            {{ $hint }}
        </p>
    @endif --}}
</label>
