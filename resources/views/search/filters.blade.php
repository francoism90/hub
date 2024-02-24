<div class="flex w-full py-1.5 flex-row flex-nowrap gap-x-6">
    <x-ui-dropdown id="sort">
        <div
            x-anchor.bottom-start="$refs.dropdown"
            class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($sorters as $item => $label)
                <label
                    for="sort-{{ $item }}"
                    @class([
                        'btn justify-start px-4 py-2 text-sm',
                        'btn-gradient' => $this->form->isSort($item),
                    ])
                >
                    <span>{{ $label }}</span>
                    @if ($this->form->isSort($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </label>

                <input
                    id="sort-{{ $item }}"
                    type="radio"
                    class="hidden"
                    value="{{ $item }}"
                    wire:model.live="sort"
                />
            @endforeach
        </div>

        <x-slot:actions>
            <button class="btn text-sm font-semibold">
                <span>{{ __('Sort') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </button>

        </x-slot:actions>
    </x-ui-dropdown>

    <x-ui-dropdown id="feature">
        <div
            x-anchor.bottom-start="$refs.dropdown"
            x-on:click.away="open = false"
            class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($features as $item => $label)
                <label
                    for="feature-{{ $item }}"
                    @class([
                        'btn justify-start px-4 py-2 text-sm',
                        'btn-gradient' => $this->form->hasFeatures($item),
                    ])
                >
                    <span>{{ $label }}</span>
                    @if ($this->form->hasFeatures($item))
                        <x-heroicon-o-check class="h-4 w-4" />
                    @endif
                </label>

                <input
                    id="feature-{{ $item }}"
                    type="checkbox"
                    class="hidden"
                    value="{{ $item }}"
                    wire:model.live="features"
                />
            @endforeach
        </div>

        <x-slot:actions>
            <button class="btn text-sm font-semibold">
                <span>{{ __('Features') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </button>
        </x-slot:content>
    </x-ui-dropdown>
</div>
