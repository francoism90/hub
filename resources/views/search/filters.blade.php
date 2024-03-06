<x-livewire-use::layout.join class="gap-x-6">
    <x-livewire-use::dropdown>
        <x-livewire-use::actions.button class="text-sm font-semibold">
            <span>{{ __('Sort') }}</span>
            <x-heroicon-m-chevron-down
                class="h-4 w-4"
                x-bind:class="open ? 'rotate-180' : ''"
            />
        </x-livewire-use::actions.button>

        <x-livewire-use::dropdown.content
            x-anchor.bottom-end.offset.5="$refs.dropdown"
            class="w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($sorters as $item => $label)
                <x-livewire-use::form.label
                    for="sort-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->isSort($item),
                    ])
                >
                    <input
                        id="sort-{{ $item }}"
                        type="radio"
                        class="hidden"
                        value="{{ $item }}"
                        wire:model.live="form.sort"
                    />

                    {{ $label }}

                    @if ($this->form->isSort($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </x-livewire-use::form.label>
            @endforeach
        </x-livewire-use::dropdown.content>
    </x-livewire-use::dropdown>

    <x-livewire-use::dropdown>
        <x-livewire-use::actions.button class="text-sm font-semibold">
            <span>{{ __('Features') }}</span>
            <x-heroicon-m-chevron-down
                class="h-4 w-4"
                x-bind:class="open ? 'rotate-180' : ''"
            />
        </x-livewire-use::actions.button>

        <x-livewire-use::dropdown.content
            x-anchor.bottom-end.offset.5="$refs.dropdown"
            class="w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($features as $item => $label)
                <x-livewire-use::form.label
                    for="feature-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->isSort($item),
                    ])
                >
                    <input
                        id="feature-{{ $item }}"
                        type="checkbox"
                        class="hidden"
                        value="{{ $item }}"
                        wire:model.live="form.sort"
                    />

                    {{ $label }}

                    @if ($this->form->hasFeatures($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </x-livewire-use::form.label>
            @endforeach
        </x-livewire-use::dropdown.content>
    </x-livewire-use::dropdown>
</x-livewire-use::layout.join>
