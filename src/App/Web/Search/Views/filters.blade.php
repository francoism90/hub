<div class="flex w-full flex-row flex-nowrap space-x-6">
    <x-layouts::dropdown>
        <button class="btn text-sm font-semibold">
            <span>{{ $this->sorter }}</span>
            <x-heroicon-m-chevron-down
                class="h-4 w-4"
                x-bind:class="open ? 'rotate-180' : ''" />
        </button>

        <x-slot:content>
            <div
                @click.away="open = false"
                class="absolute left-0 top-8 w-44 min-w-[11rem] bg-gray-900 py-2">
                @foreach ($this->sorters as $key => $label)
                    <label
                        for="sort-{{ $key }}"
                        class="btn @if ($this->hasSort($key)) btn-gradient @endif justify-start px-4 py-2 text-sm">
                        <span>{{ $label }}</span>
                        @if ($this->hasSort($key))
                            <x-heroicon-o-check class="h-4 w-4" />
                        @endif
                    </label>

                    <input
                        type="radio"
                        id="sort-{{ $key }}"
                        class="hidden"
                        value="{{ $key }}"
                        wire:model.live="form.sort" />
                @endforeach
            </div>
        </x-slot:content>
    </x-layouts::dropdown>

    <x-layouts::dropdown>
        <button class="btn text-sm font-semibold">
            <span>{{ __('Features') }}</span>
            <x-heroicon-m-chevron-down
                class="h-4 w-4"
                x-bind:class="open ? 'rotate-180' : ''" />
        </button>

        <x-slot:content>
            <div
                @click.away="open = false"
                class="absolute left-0 top-8 w-44 min-w-[11rem] bg-gray-900 py-2">
                @foreach ($this->features as $key => $label)
                    <label
                        for="feature-{{ $key }}"
                        class="btn @if ($this->hasFeature($key)) btn-gradient @endif justify-start px-4 py-2 text-sm">
                        <span>{{ $label }}</span>
                        @if ($this->hasFeature($key))
                            <x-heroicon-o-check class="h-4 w-4" />
                        @endif
                    </label>

                    <input
                        type="checkbox"
                        id="feature-{{ $key }}"
                        class="hidden"
                        value="{{ $key }}"
                        wire:model.live="form.feature" />
                @endforeach
            </div>
        </x-slot:content>
    </x-layouts::dropdown>
</div>
