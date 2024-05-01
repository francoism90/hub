@props([
    'id',
    'form',
])

@php
    $selected = $this->getPropertyValue($attributes->wireModel());
    $queryModel = "{$form->getPropertyName()}.query";
@endphp

<div {{ $attributes
        ->cssClass([
            'layer' => 'flex flex-col gap-y-3',
            'field' => 'flex items-start gap-2 pt-1 w-full',
            'item' => 'inline-flex items-center gap-2 px-2 py-1 rounded-xs text-xs bg-secondary-500',
            'error' => '!border-red-500',
        ])
        ->classMerge([
            'layer',
            'error' => $errors->has($id),
        ])
        ->merge([
            'x-data' => 'tags',
            'x-modelable' => 'tags',
        ])
}}>
    <x-dashboard.forms.input
        id="{{ $queryModel }}"
        wire:model.live="{{ $queryModel }}"
        placeholder="{{ __('Find tag') }}"
    />

    <div class="{{ $attributes->classFor('field') }}">
        <template x-for="(tag, index) in tags" :key="tag">
            <a
                x-text="selected[tag]"
                x-on:click="tags.splice(index, 1)"
                class="{{ $attributes->classFor('item') }}"
            >
            </a>
        </template>
    </div>
</div>

@script
    <script data-navigate-track>
        Alpine.data('tags', () => ({
            tags: [],
            selected: @json($form->getModels($selected)),
        }));
    </script>
@endscript
