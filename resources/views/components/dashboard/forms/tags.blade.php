@props([
    'id',
    'form',
])

@php
    $selected = $this->getPropertyValue($attributes->wireModel());
@endphp

<div {{ $attributes
        ->cssClass([
            'layer' => 'flex flex-col gap-y-3',
            'field' => 'flex items-start gap-2 p-3 min-h-24 max-h-32 w-full bg-secondary-800/90 border border-secondary-500/50 text-base focus:border-secondary-500 focus:border-2 focus:ring-0',
            'error' => '!border-red-500',
        ])
        ->classMerge([
            'layer',
            'error' => $errors->has($id),
        ])
}}>
    <x-dashboard.forms.input
        id="tags.tag"
        {{-- wire:model.live="form.tagger" --}}
        placeholder="{{ __('Find tag') }}"
    />

    <div class="{{ $attributes->classFor('field') }}">
        @foreach ($form->getModels($selected) as $model)
            {{ $model->name }}
        @endforeach
    </div>
</div>
