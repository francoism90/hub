@props([
    'id',
    'form',
])

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
    <x-dashboard.forms.field class:layer="relative flex flex-col">
        <x-dashboard.forms.input
            x-on:click="open = ! open"
            id="tags.query"
            wire:model.live="tags.query"
            autocomplete="off"
            placeholder="{{ __('Filter tags') }}"
        />

        <div
            x-cloak
            x-show="open"
            class="absolute z-50 top-12 inset-0"
        >
            <div class="flex flex-col w-full divide-y divide-solid divide-secondary-500/50 border border-secondary-500/50 bg-secondary-800">
                @foreach ($form->getResults() as $id => $value)
                    <a
                        x-on:click="add('{{ $id }}')"
                        class="text-sm hover:bg-secondary-600 px-3 py-2"
                    >
                        {{ $value }}
                    </a>
                @endforeach
            </div>
        </div>
    </x-dashboard.forms.field>

    <div class="{{ $attributes->classFor('field') }}">
        <template x-for="(tag, index) in tags" :key="tag">
            <a
                x-show="selected[tag]"
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
            selected: [],
            open: false,

            init() {
                this.$watch('tags', async (value) => {
                    this.selected = await $wire.getTagModels(value)
                })
            },

            add(id) {
                this.tags.push(id)
                this.open = false
            },
        }));
    </script>
@endscript
