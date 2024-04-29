@props([
    'property',
])

<label>
    {{ $property->getLabel() }}
</label>

<span>{{ $property->getDefault() }}</span>
