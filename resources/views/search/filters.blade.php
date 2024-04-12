<x-wireui::layout-join class="gap-x-6">
    <x-wireui::actions-dropdown>
        <x-slot:actions>
            <x-wireui::actions-button class="text-sm font-semibold">
                <span>{{ __('Sort') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </x-wireui::actions-button>
        </x-slot:actions>

        <div
            x-anchor.bottom-start.offset.5="$refs.dropdown"
            class="w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($sorters as $item => $label)
                <div
                    wire:key="sort-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm cursor-pointer',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->is('sort', $item),
                    ])
                >
                    <x-wireui::forms-label for="sort-{{ $item }}">
                        {{ $label }}

                        @if ($this->form->is('sort', $item))
                            <x-heroicon-o-check class="h-4 w-4" />
                        @endif
                    </x-wireui::forms-label>

                    <input
                        id="sort-{{ $item }}"
                        type="radio"
                        class="hidden"
                        value="{{ $item }}"
                        wire:model.live="form.sort"
                    />
                </div>
            @endforeach
        </div>
    </x-wireui::actions-dropdown>

    <x-wireui::actions-dropdown>
        <x-slot:actions>
            <x-wireui::actions-button class="text-sm font-semibold">
                <span>{{ __('Features') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </x-wireui::actions-button>
        </x-slot:actions>

        <div
            x-anchor.bottom-start.offset.5="$refs.dropdown"
            class="w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
        >
            @foreach ($features as $item => $label)
                <div
                    wire:key="feature-{{ $item }}"
                    @class([
                        'py-2 px-4 text-sm cursor-pointer',
                        'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500' => $this->form->contains('features', $item),
                    ])
                >
                    <x-wireui::forms-label for="feature-{{ $item }}">
                        {{ $label }}

                        @if ($this->form->contains('features', $item))
                            <x-heroicon-o-check class="h-4 w-4" />
                        @endif
                    </x-wireui::forms-label>

                    <input
                        id="feature-{{ $item }}"
                        type="checkbox"
                        class="hidden"
                        value="{{ $item }}"
                        wire:model.live="form.features"
                    />
                </div>
            @endforeach
        </div>
    </x-wireui::actions-dropdown>
</x-wireui::layout-join>
