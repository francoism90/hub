<aside class="hidden w-72 min-w-72 max-w-72 flex-col gap-y-4 self-start sm:flex">
    @can('viewAny', Domain\Tags\Models\Tag::class)
        <div class="w-full rounded border border-gray-700/10 bg-gray-900/75 p-4">
            <h3 class="headline pb-3.5 text-sm">{{ __('Tags') }}</h3>

            <div class="flex max-h-96 flex-col gap-y-2 overflow-y-scroll">
                @foreach ($ordered($this->form->tags) as $item)
                    <label
                        for="tag-{{ $item->getRouteKey() }}"
                        @class([
                            'link text-sm uppercase',
                            'link-active' => $this->form->hasTags($item),
                        ])
                    >
                        {{ $item->name }}
                    </label>

                    <input
                        id="tag-{{ $item->getRouteKey() }}"
                        type="checkbox"
                        class="hidden"
                        value="{{ $item->getRouteKey() }}"
                        wire:model.live="tags"
                    />
                @endforeach
            </div>
        </div>
    @endcan
</aside>
