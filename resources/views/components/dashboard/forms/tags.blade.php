@props([
    'id',
    'items',
])

@php
    $tags = $items->select(['name', 'prefixed_id'])->toArray();
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
        ->merge([
            'x-data' => 'tags',
            'id' => $id,
        ])
}}>
    <x-dashboard.forms.input
        id="form.tagger"
        wire:model.live="form.tagger"
        placeholder="{{ __('Find tag') }}"
    />

    <div class="{{ $attributes->classFor('field') }}">
        <template x-for="(tag, index) in tags" :key="tag.prefixed_id">
            <a
                x-text="tag.name"
                x-on:click="tags.splice(index, 1)"
            >
            </a>
        </template>
    </div>
</div>

@script
    <script data-navigate-track>
        Alpine.data('tags', () => ({
            selected: $wire.entangle('{{ $id }}'),
            tags: {{ Js::from($tags) }},

            async init() {
                this.$watch('tags', (value) => {
                    values = JSON.parse(JSON.stringify(value))
                    this.selected = values.map(obj => obj?.prefixed_id)
                })
            },
        }));
    </script>
@endscript
