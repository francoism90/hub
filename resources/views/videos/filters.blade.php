<aside class="hidden w-72 min-w-72 max-w-72 flex-col gap-y-4 self-start sm:flex">
    @can('viewAny', Domain\Tags\Models\Tag::class)
        <div class="w-full rounded border border-gray-700/10 bg-gray-900/75 p-4">
            <h3 class="font-medium uppercase text-primary-500 pb-3.5 text-sm">
                {{ __('Tags') }}
            </h3>

            <div class="flex max-h-96 flex-col gap-y-2 overflow-y-scroll">
                @foreach ($ordered($this->form->tags) as $item)
                    <div
                        wire:key="filter-{{ $item->getRouteKey() }}"
                        @class([
                            'uppercase text-sm hover:text-primary-400',
                            'text-primary-400 hover:text-primary-300' => $this->form->contains('tags', $item->getRouteKey()),
                        ])
                    >
                        <x-livewire-use::forms-label for="filter-{{ $item->getRouteKey() }}">
                            {{ $item->name }}
                        </x-livewire-use::forms-label>

                        <input
                            id="filter-{{ $item->getRouteKey() }}"
                            type="checkbox"
                            class="hidden"
                            value="{{ $item->getRouteKey() }}"
                            wire:model.live="tags"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    @endcan
</aside>
