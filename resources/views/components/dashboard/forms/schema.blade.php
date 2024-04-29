@props([
    'schema',
])

<div {{ $attributes->class('flex flex-col gap-6') }}>
    @foreach ($schema->all() as $field)
        @if ($field?->hasComponent())
            <x-dynamic-component :component="$field->getComponent()" :$field />
        @endif

        @if ($field?->hasLivewire())
            @livewire($field->getLivewire(), ['field' => $field], key($field->getName()))
        @endif
    @endforeach
</div>
