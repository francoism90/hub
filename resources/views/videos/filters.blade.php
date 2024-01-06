<aside class="hidden w-72 min-w-72 max-w-72 flex-col gap-y-4 self-start sm:flex">
    @can('viewAny', Domain\Tags\Models\Tag::class)
        <div class="w-full rounded border border-gray-700/10 bg-gray-900/75 p-4">
            <h3 class="headline text-sm pb-3.5">{{ __('Tags') }}</h3>

            <div class="flex flex-col gap-y-2 overflow-y-scroll max-h-96">
                @foreach ($ordered($this->form->tags) as $item)
                    <label
                        for="tag-{{ $item->getRouteKey() }}"
                        @class([
                            'link text-sm font-medium uppercase',
                            'link-active' => $this->form->hasTags($item),
                        ])
                    >
                        {{ $item->name }}
                    </label>

                    <input
                        type="checkbox"
                        class="hidden"
                        id="tag-{{ $item->getRouteKey() }}"
                        value="{{ $item->getRouteKey() }}"
                        wire:model.live="form.tags"
                    />
                @endforeach
            </div>
        </div>
    @endcan
</aside>
