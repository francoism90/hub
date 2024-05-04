@props([
    'prepend' => null,
    'append' => null,
    'label' => null,
    'hint' => null,
    'items' => [],
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'flex flex-col gap-y-3 relative',
        'items' => 'flex items-start gap-2 pt-1 w-full',
        'item' => 'inline-flex items-center gap-2 px-2 py-1 rounded-xs text-xs bg-secondary-500',
        'error' => '!border-red-500',
    ])
    ->classMerge([
        'layer',
    ])
    ->merge([
        'x-data' => 'tags',
        'x-modelable' => 'tags',
    ])
}}>
    <x-dashboard.forms.input
        :$append
        :$prepend
        x-on:click="open = ! open"
        label="{{ __('Tags') }}"
        id="tags.query"
        wire:model.live="tags.query"
        autocomplete="off"
        placeholder="{{ __('Filter tags') }}"
    />

    <div
        x-cloak
        x-show="open"
        x-on:click.outside="open = false"
        class="absolute z-50 top-20 inset-0"
    >
        @if ($items->isNotEmpty())
        <div class="flex flex-col w-full divide-y divide-solid divide-secondary-500/50 border border-secondary-500/50 bg-secondary-800">
            @foreach ($items as $option)
                <a
                    x-on:click="add({{ Js::from($option) }})"
                    class="text-sm hover:bg-secondary-600 px-3 py-2"
                >
                    {{ $option['name'] }}
                </a>
            @endforeach
        </div>
        @endif
    </div>

    <div class="{{ $attributes->classFor('items') }}">
        <template x-for="(tag, index) in tags" :key="tag.id">
            <a
                x-text="tag.name"
                x-on:click="tags.splice(index, 1)"
                class="{{ $attributes->classFor('item') }}"
            >
            </a>
        </template>
    </div>

    @error($attributes->wireKey())
        <p class="text-secondary-500">
            {{ $message }}
        </p>
    @enderror
</div>

@script
    <script>
        Alpine.data('tags', () => ({
            tags: [],
            open: false,

            add(tag) {
                const index = this.tags.findIndex((item) => item.id === tag.id);

                if (index === -1)
                    this.tags.push(tag)

                this.open = false;
            },
        }));
    </script>
@endscript
