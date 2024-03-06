<div class="flex w-full flex-nowrap gap-x-6 py-1.5">
    <x-ui-dropdown id="sort">
        <div
            x-anchor.bottom-start="$refs.dropdown"
            class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($sorters as $item => $label)
                <x-forms-label
                    for="sort-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->isSort($item),
                    ])
                >
                    <span>{{ $label }}</span>
                    @if ($this->form->isSort($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </x-forms-label>

                <input
                    id="sort-{{ $item }}"
                    type="radio"
                    class="hidden"
                    value="{{ $item }}"
                    wire:model.live="form.sort"
                />
            @endforeach
        </div>

        <x-slot:actions>
            <x-livewire-use::actions.button class="text-sm font-semibold">
                <span>{{ __('Sort') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </x-livewire-use::actions.button>

        </x-slot:actions>
    </x-ui-dropdown>

    <x-ui-dropdown id="feature">
        <div
            x-anchor.bottom-start="$refs.dropdown"
            x-on:click.away="open = false"
            class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($features as $item => $label)
                <x-forms-label
                    for="feature-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->hasFeatures($item),
                    ])
                >
                    <span>{{ $label }}</span>
                    @if ($this->form->hasFeatures($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </x-forms-label>

                <input
                    id="feature-{{ $item }}"
                    type="checkbox"
                    class="hidden"
                    value="{{ $item }}"
                    wire:model.live="form.features"
                />
            @endforeach
        </div>

        <x-slot:actions>
            <x-livewire-use::actions.button class="text-sm font-semibold">
                <span>{{ __('Features') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </x-livewire-use::actions.button>
        </x-slot:content>
    </x-ui-dropdown>
</div>
